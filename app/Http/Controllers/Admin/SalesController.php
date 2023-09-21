<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\InventoryTransaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ReturnProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;
use Crypt;
use DB;
use Session;
use Carbon\Carbon;
use Auth;
use PDF;
use App\Models\ProductSku;
class SalesController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->where('order_type', 'pos');
        if(isset($request->search) && !empty($request->search)) {
            $orders->where(function($query) use($request){
                $query->where('customer_name', 'like', '%'.$request->search.'%')
                ->orwhere('customer_mobile', 'like', '%'.$request->search.'%');
            });
        }
        if(isset($request->refrence_number) && !empty($request->refrence_number)) {
            $orders->where('order_number', 'like', '%'.$request->refrence_number.'%');
        }

        if(isset($request->start_date) && !empty($request->start_date)) {
            $orders->wheredate('order_date', '>=' ,$request->start_date);
        }
        if(isset($request->end_date) && !empty($request->end_date)) {
            $orders->wheredate('order_date', '<=' ,$request->end_date);
        }
        if(isset($request->payment_status) && !empty($request->payment_status)) {
            $orders->wherein('payment_status',$request->payment_status);
        }
        $orders = $orders->paginate(20);
        return view('admin.sales.saleslist', compact('orders', 'request'));
    }

    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->whereNull('p_id')->where('status', 'active')->get();
        $brands = Brand::orderBy('id', 'desc')->where('status', 'active')->get();
        $customers = User::where('type', 'customer')->where('status', 'active')->get();
        return view('admin.sales.pos', compact('categories', 'brands', 'customers'));
    }

    public function getProducts(Request $request)
    {
        $products = ProductSku::
        with('product')
        ->whereHas('inventories');

        $products->where(function($query) use($request){
            if(isset($request->filter_product) && !empty($request->filter_product)) {

                $query->whereHas('product', function($sub_query) use($request){

                    $sub_query->where('name', 'like', '%'.$request->filter_product.'%');
                });
            }

            if(isset($request->filter_brand) && !empty($request->filter_brand)) {
                $query->orwherehas('brand', function($sub_query) use($request){
    
                    $sub_query->where('name', 'like', '%'.$request->filter_brand.'%');
                });
            }
            if(isset($request->filter_sub_brand) && !empty($request->filter_sub_brand)) {
                $query->orwherehas('brand', function($sub_query) use($request){
    
                    $sub_query->where('name', 'like', '%'.$request->filter_sub_brand.'%');
                });
            }
            if(isset($request->filter_category) && !empty($request->filter_category)) {
                $query->orwherehas('category', function($sub_query) use($request){
    
                    $sub_query->where('name', 'like', '%'.$request->filter_category.'%');
                });
            }
            if(isset($request->filter_subcategory) && !empty($request->filter_subcategory)) {
                $query->orwherehas('subcategory', function($sub_query) use($request){
    
                    $sub_query->where('name', 'like', '%'.$request->filter_subcategory.'%');
                });
            }
           
        });

        $skus = $products->get();
        // return response(['data' => $skus]);
        // $skus = $products;
        $data = view('admin.sales.product_list', compact('skus'))->render();
        return response(['data' => $data]);

        $products = Product::orderBy('id', 'desc');
       
        // if(isset($request->category) && !empty($request->category)) {
        //     $products->whereIn('category_id', $request->category);
        // }
        // if(isset($request->subcategory) && !empty($request->subcategory)) {
        //     $products->where('subcategory_id', $request->subcategory);
        // }
        // if(isset($request->brand) && !empty($request->brand)) {
        //     $products->whereIn('brand_id', $request->brand);
        // }
        // if(isset($request->sub_brand) && !empty($request->sub_brand)) {
        //     $products->whereIn('sub_brand_id', $request->sub_brand);
        // }
        if(isset($request->filter_product) && !empty($request->filter_product)) {
            $products->where('name', 'like', '%'.$request->filter_product.'%');
        }
        if(isset($request->filter_brand) && !empty($request->filter_brand)) {
            $products->wherehas('brand', function($query) use($request){

                $query->where('name', 'like', '%'.$request->filter_brand.'%');
            });
        }
        if(isset($request->filter_sub_brand) && !empty($request->filter_sub_brand)) {
            $products->wherehas('brand', function($query) use($request){

                $query->where('name', 'like', '%'.$request->filter_sub_brand.'%');
            });
        }
        if(isset($request->filter_category) && !empty($request->filter_category)) {
            $products->wherehas('category', function($query) use($request){

                $query->where('name', 'like', '%'.$request->filter_category.'%');
            });
        }
        if(isset($request->filter_subcategory) && !empty($request->filter_subcategory)) {
            $products->wherehas('subcategory', function($query) use($request){

                $query->where('name', 'like', '%'.$request->filter_subcategory.'%');
            });
        }
       
        $products = $products->get();

        $data = view('admin.sales.product_list', compact('products'))->render();
        return response(['data' => $data]);
    }

    public function addToCart(Request $request)
    {
        if(strtolower($request->type) == 'pos_order') {

            $product_id = $request->product_id;
            $term = ProductInventory::find($product_id);
            $image_url = '';
            if( $term->product && $term->product->primaryImage) {
                $image_url = asset('uploads/products/'.$term->product->primaryImage->image);
            }
            $product_name = $term->product->productFullName();
    
    
            Cart::instance('pos_order')->add($term->id, $product_name, 1, $term->sku->price, 0, [ 'sku_id' => $term->sku_id, 'sku' => $term->sku->sku, 'preview' => $image_url, 'mrp'=> $term->sku->mrp]);
            $data = view('admin.sales.cart_list')->render();
            $subtotal = Cart::instance('pos_order')->subtotal();
            $total = Cart::instance('pos_order')->total();
            $quantity = Cart::instance('pos_order')->count();
            return response(['data' => $data, 'subtotal' => $subtotal, 'total' => $total, 'quantity' => $quantity]);
        
        }
        else {
            $product_id = $request->product_id;
            $term = ProductInventory::find($product_id);
            $image_url = '';
            if( $term->product && $term->product->primaryImage) {
                $image_url = asset('uploads/products/'.$term->product->primaryImage->image);
            }
            $product_name = $term->product->productFullName();
    
    
            Cart::instance('customer_order')->add($term->id, $product_name, 1, $term->sale_price, 0, [ 'sku_id' => $term->sku_id, 'sku' => $term->sku->sku, 'preview' => $image_url, 'mrp'=> $term->sku->mrp]);
            $data = view('admin.sales.cart_list')->render();
            $subtotal = Cart::instance('customer_order')->subtotal();
            $total = Cart::instance('customer_order')->total();
            $quantity = Cart::instance('customer_order')->count();
            return response(['data' => $data, 'subtotal' => $subtotal, 'total' => $total, 'quantity' => $quantity]);
    
        }
    }


    public function updateAddToCart(Request $request)
    {
        $rowId = $request->cart_id;
        $item = Cart::instance('pos_order')->get($rowId);
        $quantity = $item->qty;
        if($request->value == '-') {
            $quantity -= 1;
        }
        elseif($request->value == '+') {
            $quantity += 1;
           
        }
        $inventory = ProductInventory::find($item->id);
        if ($inventory->left_quantity > $quantity) {
            
            Cart::instance('pos_order')->update($rowId, $quantity); 
        }
        $data = view('admin.sales.cart_list')->render();
        $subtotal = Cart::instance('pos_order')->subtotal();
        $total = Cart::instance('pos_order')->total();
        $quantity = Cart::instance('pos_order')->count();

        return response(['data' => $data, 'subtotal' => $subtotal, 'total' => $total, 'quantity' => $quantity]);
    }

    public function deleteAddToCart(Request $request)
    {
        $rowId = $request->cart_id;
        if(empty($rowId)) {
            Cart::instance('pos_order')->destroy();
        }
        else {

            Cart::instance('pos_order')->update($rowId, 0); 
        }
        $data = view('admin.sales.cart_list')->render();
        $subtotal = Cart::instance('pos_order')->subtotal();
        $total = Cart::instance('pos_order')->total();
        $quantity = Cart::instance('pos_order')->count();

        return response(['data' => $data, 'subtotal' => $subtotal, 'total' => $total, 'quantity' => $quantity]);
    }



    public function placeOrder(Request $request)
    {
        DB::beginTransaction();
        if(empty($request->customer_type)) {

            $request->validate([
                'customer_name' => 'required|max:255',
                'mobile_no' => 'required',
                'payment_type' => 'required',
                'paid_amount' => 'required|numeric',
               'gst_amount' => 'nullable|numeric|max:100|min:0'
    
            ]);
        }

        if(Cart::instance('pos_order')->count() == 0) {
            $error['errors']['error'] = 'Cart is empty';
            return response()->json($error, 422);
        }
        $total = Cart::instance('pos_order')->total();
        $discount = (float)$request->discount_amount ?? 0;
        $final_amount = $total-$discount;
        
        $gst_amount = 0;
        if(!empty($request->gst_amount) && $request->gst_amount > 0) {
            $gst_amount = ($request->gst_amount/100)*$final_amount;
            $final_amount += $gst_amount;
        }
        if ($final_amount < $request->paid_amount) {
            $error['errors']['paid_amount'] = 'Invalid paid amount';
            return response()->json($error, 422);
        }
        $payment_status = '';
        if($final_amount == $request->paid_amount) {
            $payment_status = 'paid';
        }
        else if($final_amount > $request->paid_amount) {
            $payment_status = 'partial';
        }
        else if($request->paid_amoun == 0) {
            $payment_status = 'unpaid';
        }

        $order_data = [
            'quantity' => Cart::instance('pos_order')->count(),
            'payment_type' => $request->payment_type,
            'subtotal' => Cart::instance('pos_order')->subtotal(),
            'discount_type' => 'fixed',
            'discount_amount' => $discount,
            'total_amount' => $total,
            'payable_amount' => $final_amount,
            'order_status' => 'delivered',
            'payment_status' => $payment_status ,
            'order_type' => 'pos',
            'customer_id' => $request->customer_type,
            'order_date' => Carbon::now(),
            'store_id' => Auth::id(),
            'due_amount' => $final_amount-$request->paid_amount,
            'paid_amount' => $request->paid_amount,
            'gst_percentage' => $request->gst_amount,
            'gst_amount' => $gst_amount
        ];
        $order_data['customer_name'] = $request->customer_name;
        $order_data['customer_mobile'] = $request->mobile_no;
        if(!empty($request->customer_type)) {
            $customer = User::where(['type' => 'customer', 'id' => $request->customer_type])->first();
            if($customer) {
                $order_data['customer_name'] = $customer->name;
                $order_data['customer_mobile'] = $customer->contact;

            }
        }
        $order = Order::create($order_data);
        if($order) {
            $orde_zero = '00000000000000000';
            if(strlen($order->id) < 6) {
                $order_number = 'ORD-'.substr($orde_zero, 0, (strlen($order->id)-1)).$order->id;
            }
            else {
                $order_number = 'ORD-'.$order->id;
            }
            $order->order_number = $order_number;
            $order->save();
        
            $item_data = [];
            foreach (Cart::instance('pos_order')->content() as $cart) {
                $inventory = ProductInventory::find($cart->id);
                if ($inventory) {

                    $product_name = $inventory->product->productFullName();
                    $options = $cart->options;
                    $options['additional_data'] = $inventory->sku->productAttributes;
                    $item_data = [
                        'order_id' => $order->id,
                        'inventory_id' => $inventory->id,
                        'sku_id' => $inventory->sku_id,
                        'sku_code' => $inventory->sku->sku ?? '',
                        'description' => $product_name,
                        'amount' => $cart->price,
                        'quantity' => $cart->qty,
                        'item_options' => $options,
                        'type' => 'product',
                        'purchase_price' => $inventory->unit_price,
                        // 'left_quantity' => $cart->qty
                    ];
                    OrderItem::insert($item_data);

                    $inventory->left_quantity = $inventory->left_quantity-$cart->qty;
                    $inventory->save();
                }
            }
            // return response(['status' =>$item_data, 422]);
            $transaction = InventoryTransaction::create(['linkable_type' => 'sales', 'linkable_id' => $order->id, 'total_amount' =>  $order->payable_amount, 'paid_amount' => $request->paid_amount, 'due_amount' => $order->due_amount, 'created_by' => Auth::id(), 'payment_type' => $request->payment_type, 'transaction_date' => $order->created_at]);

    
            Cart::instance('pos_order')->destroy();
            DB::commit();
            Session::flash('success', 'Order is successfully placed');
            return response(['status' =>'success', 'url' => route('admin.sales.create')]);
        }
    }


    public function show($order_id)
    {
        $order = Order::where(['id'=> $order_id])->where('order_type', 'pos')->first();
        return view('admin.sales.sales-details', compact('order'));
    }


    public function updateAddToCartPrice(Request $request)
    {
        $rowId = $request->cart_id;
        $amount = $request->amount;
        if(empty($request->amount)) {
            $amount = 0;
        }
        Cart::instance('pos_order')->update($rowId, ['price' => $amount]);
        $data = view('admin.sales.cart_list')->render();
        $subtotal = Cart::instance('pos_order')->subtotal();
        $total = Cart::instance('pos_order')->total();
        $quantity = Cart::instance('pos_order')->count();

        return response(['data' => $data, 'subtotal' => $subtotal, 'total' => $total, 'quantity' => $quantity]);
    }


    public function orderTransaction(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'order_id' => 'required',
            'amount_paid' => 'required|numeric',
            'payment_type' => 'required'
        ]);
        $order = Order::where('id', $request->order_id)->first();
        if($order) {
            if($order->due_amount < $request->amount_paid) {
                $error['errors']['amount_paid'] = 'Paid amount is invalid';
                return response()->json($error, 422);
            }
    
        }
        $due_amount = $order->due_amount-$request->amount_paid;
        $transaction = InventoryTransaction::create(['note' => $request->note ,'linkable_type' => 'sales', 'linkable_id' => $order->id, 'total_amount' =>  $order->due_amount, 'paid_amount' => $request->amount_paid, 'due_amount' => $due_amount, 'created_by' => Auth::id(), 'payment_type' => $request->payment_type, 'transaction_date' => $request->transaction_date]);
   
        $order->paid_amount = $order->payable_amount-$due_amount;
        $order->due_amount = $due_amount;
        if($due_amount == 0 ) {
            $order->payment_status = 'paid';
        }
        elseif($due_amount == $order->payable_amount) {
            $order->payment_status = 'unpaid';
        }
        elseif($due_amount < $order->payable_amount) {
            $order->payment_status = 'partial';
        }
        $order->save();
        DB::commit();
        Session::flash('success', 'Sales Transaction  successfully added');
        return response(['status' => 'success']);


    }

    public function invoice($order_id)
    {
        $order = Order::where('id',$order_id)->where('order_type', 'pos')->first();
        $pdf = PDF::loadView('admin.sales.invoice', ['order' => $order]);
        return $pdf->stream("invoice.pdf", array("Attachment" => false));
    }


    public function returnCreate(Request $request)
    {
        $order = [];
        if(isset($request->order_number) && !empty($request->order_number)) {

            $order = Order::where(['order_number' => $request->order_number])->first();
        }
       return view('admin.sales.createsalesreturns', compact('request', 'order'));
    }

    public function returnIndex(Request $request)
    {
        $return_items = ReturnProduct::where('linkable_type', 'sales')->where('quantity', '>', 0)->orderBy('id', 'desc');
        if(isset($request->order_number) && !empty($request->order_number)) {
            $return_items->whereHas('order', function($query) use ($request){
                if(isset($request->order_number) && !empty($request->order_number)) {
                    $query->where('order_number', $request->order_number);   
                }
                if(isset($request->search) && !empty($request->search)) {
                    $query->where(function($subquery) use($request){
                        $subquery->where('customer_name', 'like', '%'.$request->search.'%')
                        ->orwhere('customer_mobile', 'like', '%'.$request->search.'%');
                    });
                }
            });
        }
       
       
        if(isset($request->start_date) && !empty($request->start_date)) {
            $return_items->wheredate('return_date', '>=' ,$request->start_date);
        }
        if(isset($request->end_date) && !empty($request->end_date)) {
            $return_items->wheredate('return_date', '<=' ,$request->end_date);
        }
        if(isset($request->payment_type) && !empty($request->payment_type)) {
            $return_items->where('payment_type',$request->payment_type);
        }

        $return_items = $return_items->paginate('20');
       return view('admin.sales.salesreturnlists', compact('request', 'return_items'));
    }

    public function returnUpdate(Request $request, $order_id)
    {
        $request->validate([
            'return_date' => 'required|date',
            'payment_type' => 'required'
        ]);

        DB::beginTransaction();
        $order_id = Crypt::decryptString($order_id);
        $input = $request->all();
        foreach($request->items as $key => $item) {

            $return_quantity = $input['return_quanity_'.$item];
            $type = $input['type_'.$item];
            $reason = $input['reason_'.$item];
            $order_item = OrderItem::find($item);
            if($order_item) {
                if(empty($return_quantity) || $return_quantity <= 0) {
                    $error['errors']['return_quanity_'.$item] = 'Reutrn quantity should be greater than 0.';
                    return response()->json($error, 422);
                }
                if(($order_item->quantity - $order_item->return_quantity) < $return_quantity) {
                    $error['errors']['return_quanity_'.$item] = 'Reutrn quantity should be less than or equal to current quantity : '.$order_item->return_quantity;
                    return response()->json($error, 422);
                }

                $order_item->return_quantity = $order_item->return_quantity+$return_quantity;
                $order_item->left_quantity = $order_item->quantity - $order_item->return_quantity;

                $order_item->save();
                $return_item = ReturnProduct::where(['linkable_type' => 'sales',
                                                    'item_id' => $item,
                                                    'return_date' => $request->return_date,
                                                    'type' => $type,
                                                    'note' => $request->note,
                                                    'payment_type' => $request->payment_type])
                                                    ->first();
                if(!$return_item)  {
                    $return_item = new ReturnProduct();
                    $return_item->linkable_type = 'sales';
                    $return_item->linkable_id = $order_id;
                    $return_item->item_id = $item;
                    $return_item->quantity = $return_quantity;
                    $return_item->note = $request->note;
                    $return_item->payment_type = $request->payment_type;
                    $return_item->type = $type;
                    $return_item->return_date = $request->return_date;
                    $return_item->reason = $reason;
                }
                else {
                    $return_item->quantity = $return_item->quantity+ $return_quantity;
                  
                }

                $return_item->save();
            }

        }
        DB::commit();
        Session::flash('success', 'Sales return  successfully added');
        return response(['status' => 'success' , 'url' => route('admin.sales.return.index')]);



    }

    public function returnEdit($return_id)
    {
        $item = ReturnProduct::where(['linkable_type' => 'sales', 'id' => $return_id])->first();
        return view('admin.sales.editsalesreturn', compact('item'));
    }

    public function returnUpdateitem(Request $request, $item_id)
    {
        $request->validate([
            'return_date' => 'required|date',
            'payment_type' => 'required',
            'reason' => 'required',
            'type' => 'required',
            'payment_type' => 'required'
        ]);

        DB::beginTransaction();
        $return_item = ReturnProduct::find($item_id);
        $input = $request->all();
        $revert_quantity = $request->revert_quantity;
        $type = $input['type'];
        $reason = $input['reason'];
        if($return_item) {
            if(empty($revent_quantity) || $revert_quantity > 0) {
                if($revert_quantity > $return_item->quantity) {
                    $error['errors']['revert_quantity'] = 'Reutrn quantity should be less than or equal to '.$return_item->quantity;
                    return response()->json($error, 422);
                }
                $return_item->revert_quantity = $return_item->revert_quantity+$revert_quantity;
                $return_item->quantity = $return_item->quantity - $return_item->revert_quantity;

                if($return_item->orderItem) {
                    $item = $return_item->orderItem;
                    $item->left_quantity =  $item->left_quantity + $revert_quantity;
                    $item->return_quantity = $item->quantity - $item->left_quantity;
                    $item->save();
                }
            }
            else {
                $return_item->revert_quantity = $return_item->quantity;

              
            }

            $return_item->type = $type;
            $return_item->reason = $reason;
            $return_item->return_date = $request->return_date;
            $return_item->note = $request->note;
            $return_item->payment_type = $request->payment_type;

            $return_item->save();

        }

        
        DB::commit();
        Session::flash('success', 'Sales return  successfully updated');
        return response(['status' => 'success' , 'url' => route('admin.sales.return.index')]);



    }


    public function report(Request $request)
    {
        $items = OrderItem::orderBy('id', 'desc');
        if((isset($request->start_date) && !empty($request->state_date)) || isset($request->end_date) && !empty($request->end_date)) {
            $items->whereHas('order', function($query) use ($request){
                if(isset($request->start_date) && !empty($request->start_date)) {
                    $query->wheredate('created_at', '>=', $request->start_date);   
                }

                if(isset($request->end_date) && !empty($request->end_date)) {
                    $query->wheredate('created_at', '<=', $request->end_date);   
                }
                
            });
        }
        $items =$items->paginate(10);
        return view('admin.sales.salesreport', compact('items', 'request'));
    }


    public function getPayments($order_id)
    {
        $transactions = InventoryTransaction::where(['linkable_type' => 'sales', 'linkable_id' => $order_id, 'created_by' => Auth::id()])->orderBy('id', 'desc')->get();
        $order = Order::find($order_id);
        return view('admin.sales.payments', compact('transactions', 'order'));
    }


}
