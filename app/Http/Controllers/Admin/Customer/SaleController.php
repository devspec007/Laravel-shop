<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\InventoryTransaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Cart;
use Session;
use DB;
class SaleController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->where('order_type', 'old_order');
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
        return view('admin.customer.sale.index', compact('orders', 'request'));
    }


    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->whereNull('p_id')->where('status', 'active')->get();
        $brands = Brand::orderBy('id', 'desc')->where('status', 'active')->get();
        $customers = User::where('type', 'customer')->where('status', 'active')->get();
        return view('admin.customer.sale.create', compact('categories', 'customers', 'brands'));
    }

    public function getProducts(Request $request)
    {
        $products = Product::orderBy('id', 'desc');
       
        if(isset($request->category) && !empty($request->category)) {
            $products->whereIn('category_id', $request->category);
        }
        if(isset($request->subcategory) && !empty($request->subcategory)) {
            $products->where('subcategory_id', $request->subcategory);
        }
        if(isset($request->brand) && !empty($request->brand)) {
            $products->whereIn('brand_id', $request->brand);
        }
        if(isset($request->filter_product) && !empty($request->filter_product)) {
            $products->where('name', 'like', '%'.$request->filter_product.'%');
        }
        if(isset($request->filter_brand) && !empty($request->filter_brand)) {
            $products->wherehas('brand', function($query) use($request){

                $query->where('name', 'like', '%'.$request->filter_brand.'%');
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

        $data = view('admin.customer.sale.product_list', compact('products'))->render();
        return response(['data' => $data]);
    }



    public function placeOrder(Request $request)
    {
        // DB::beginTransaction();
        // if(empty($request->customer_type)) {

        //     $request->validate([
        //         'customer_name' => 'required|max:255',
        //         'mobile_no' => 'required',
        //         'payment_type' => 'required',
        //         'paid_amount' => 'required|numeric',
        //        'gst_amount' => 'nullable|numeric|max:100|min:0'
    
        //     ]);
        // }

        // if(Cart::instance('customer_order')->count() == 0) {
        //     $error['errors']['error'] = 'Cart is empty';
        //     return response()->json($error, 422);
        // }
        // $total = Cart::instance('customer_order')->total();
        // $discount = $request->discount_amount ?? 0;
        // $final_amount = $total-$discount;
        
        // $gst_amount = 0;
        // if(!empty($request->gst_amount) && $request->gst_amount > 0) {
        //     $gst_amount = ($request->gst_amount/100)*$final_amount;
        //     $final_amount += $gst_amount;
        // }
        // if ($final_amount < $request->paid_amount) {
        //     $error['errors']['paid_amount'] = 'Invalid paid amount';
        //     return response()->json($error, 422);
        // }
        // $payment_status = '';
        // if($final_amount == $request->paid_amount) {
        //     $payment_status = 'paid';
        // }
        // else if($final_amount > $request->paid_amount) {
        //     $payment_status = 'partial';
        // }
        // else if($request->paid_amoun == 0) {
        //     $payment_status = 'unpaid';
        // }

        // $order_data = [
        //     'quantity' => Cart::instance('customer_order')->count(),
        //     'payment_type' => $request->payment_type,
        //     'subtotal' => Cart::instance('customer_order')->subtotal(),
        //     'discount_type' => 'fixed',
        //     'discount_amount' => $discount,
        //     'total_amount' => $total,
        //     'payable_amount' => $final_amount,
        //     'order_status' => 'delivered',
        //     'payment_status' => $payment_status ,
        //     'order_type' => 'pos',
        //     'customer_id' => $request->customer_type,
        //     'order_date' => Carbon::now(),
        //     'store_id' => Auth::id(),
        //     'due_amount' => $final_amount-$request->paid_amount,
        //     'paid_amount' => $request->paid_amount,
        //     'gst_percentage' => $request->gst_amount,
        //     'gst_amount' => $gst_amount
        // ];
        // $order_data['customer_name'] = $request->customer_name;
        // $order_data['customer_mobile'] = $request->mobile_no;
        // if(!empty($request->customer_type)) {
        //     $customer = User::where(['type' => 'customer', 'id' => $request->customer_type])->first();
        //     if($customer) {
        //         $order_data['customer_name'] = $customer->name;
        //         $order_data['customer_mobile'] = $customer->contact;

        //     }
        // }
        // $order = Order::create($order_data);
        // if($order) {
        //     $orde_zero = '00000000000000000';
        //     if(strlen($order->id) < 6) {
        //         $order_number = 'ORD-'.substr($orde_zero, 0, (strlen($order->id)-1)).$order->id;
        //     }
        //     else {
        //         $order_number = 'ORD-'.$order->id;
        //     }
        //     $order->order_number = $order_number;
        //     $order->save();
        
        //     $item_data = [];
        //     foreach (Cart::instance('customer_order')->content() as $cart) {
        //         $product_name = $inventory->product->productFullName();
        //         $options = $cart->options;
        //         $options['additional_data'] = $inventory->sku->productAttributes;
        //         $item_data = [
        //             'order_id' => $order->id,
        //             'inventory_id' => $inventory->id,
        //             'sku_id' => $inventory->sku_id,
        //             'sku_code' => $inventory->sku->sku ?? '',
        //             'description' => $product_name,
        //             'amount' => $cart->price,
        //             'quantity' => $cart->qty,
        //             'item_options' => $options,
        //             'type' => 'product',
        //             'purchase_price' => $inventory->unit_price,
        //             'left_quantity' => $cart->qty
        //         ];
        //         OrderItem::insert($item_data);
        //     }
        //     // return response(['status' =>$item_data, 422]);
        //     $transaction = InventoryTransaction::create(['linkable_type' => 'sales', 'linkable_id' => $order->id, 'total_amount' =>  $order->payable_amount, 'paid_amount' => $request->paid_amount, 'due_amount' => $order->due_amount, 'created_by' => Auth::id(), 'payment_type' => $request->payment_type, 'transaction_date' => $order->created_at]);

    
        //     Cart::instance('customer_order')->destroy();
        //     DB::commit();
        //     Session::flash('success', 'Order is successfully placed');
        //     return response(['status' =>'success', 'url' => route('admin.customer-sales.create')]);
        // }
    }
}
