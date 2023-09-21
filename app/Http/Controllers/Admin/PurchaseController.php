<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PurchaseImport;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductSku;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\ReturnProduct;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Crypt;
use Exception;
use App\Traits\StockTrait;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseController extends Controller
{
    use StockTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchases = Purchase::orderBy('id', 'desc')->where('store_id', Auth::user()->getUserStoreId());
        if(isset($request->supplier) && !empty($request->supplier)) {
            $purchases->where('supplier_id', $request->supplier);
        }
        if(isset($request->refrence_number) && !empty($request->refrence_number)) {
            $purchases->where('supplier_id', 'like', '%'.$request->refrence_number.'%');
        }

        if(isset($request->start_date) && !empty($request->start_date)) {
            $purchases->wheredate('purchase_date', '>=' ,$request->start_date);
        }
        if(isset($request->end_date) && !empty($request->end_date)) {
            $purchases->wheredate('purchase_date', '<=' ,$request->end_date);
        }
        if(isset($request->payment_status) && !empty($request->payment_status)) {
            $purchases->wherein('payment_status',$request->payment_status);
        }
        $purchases = $purchases->paginate(20);
        $suppliers = User::orderBy('id', 'desc')->where('type', 'supplier')->get();

        return view('admin.purchase.purchaselist', compact('request', 'purchases', 'suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = User::getSuppliers(false);

        return view('admin.purchase.addpurchase', compact('suppliers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response(['data' =>Auth::user()], 422);
        DB::beginTransaction();
        $request->validate([
            'supplier' => 'required',
            'purchase_date' => 'required|date',
            'supplier_date' => 'required|date',
            'refrence_number' => 'required|max:255,unique,purchases',
            'sku_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'required' => 'payment_type'
        ]);

        // if($request->grand_total < $request->amount_paid) {
        //     $error['errors']['amount_paid'] = 'Paid amount is invalid';
        //     return response()->json($error, 422);
        // }
        // DB::beginTransaction();
        try {
            $data = $request->only(['purchase_date', 'refrence_number', 'note', 'supplier_date']);
            // $data['total_amount_paid'] = $request->amount_paid;
            $data['supplier_id'] = $request->supplier;
            $data['store_id'] = User::getUserStoreId();
            $data['created_by'] = auth()->user()->id;

            $purchase = Purchase::create($data);
           
            $input = $request->all();
            $total_purchase_item = 0;
            $total_item = 0;
            for($row = 0; $row < count($input['sku_id']); $row++) {
                $sku = ProductSku::find($input['sku_id'][$row]);
                $product_id = $sku->product_id;
                $total = ((float) $input['unit_price'][$row]* (float)$input['quantity'][$row]) + ($input['tax_amount'][$row]* $input['quantity'][$row]);
                $purchase_item_data = ['purchase_id' => $purchase->id, 
                                        'product_id' => $product_id, 
                                        'sku_id' => $input['sku_id'][$row], 
                                        'quantity' =>  $input['quantity'][$row], 
                                        'pending_quantity' =>  $input['quantity'][$row], 
                                        'unit_price' =>  $input['unit_price'][$row], 
                                        'total_price' => $total, 
                                        'unit_tax' => $input['tax_amount'][$row], 
                                        'margin' => $sku->mrp - $input['unit_price'][$row], 
                                        'mrp' => $sku->mrp,
                                        'purchase_tax' => $sku->product->purchase_tax,
                                        'sale_price' =>  $sku->price];
                $total_purchase_item += (float) $purchase_item_data['total_price'];
                $total_item += $input['quantity'][$row];
                $purchase_item = PurchaseItem::create($purchase_item_data);
                
            }
            $due_amount = $total_purchase_item-$purchase->total_amount_paid;
            $purchase->total_amount = $total_purchase_item;
            $purchase->total_quantity = $total_item;
            $purchase->due_amount = $due_amount;
         
            $purchase->save();
    
            // $transaction = InventoryTransaction::create(['note' => $request->note, 'linkable_type' => 'purchase', 'linkable_id' => $purchase->id, 'total_amount' =>  $purchase->total_amount, 'paid_amount' => $total_purchase_item, 'due_amount' => $purchase->due_amount, 'created_by' => Auth::id()]);
            DB::commit();
            // $error['errors']['error'] = json_encode($purchase);
            // return response()->json($error, 500);
            Session::flash('success', 'Purchase Details successfully added');
            return response(['status' => 'success' , 'url' => route('admin.purchase.index')]);
    
        }
        catch(Exception $exception) {
            DB::rollback();
            $error['errors']['error'] = $exception->getMessage();
            return response()->json($error, 500);
        }
       


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $purchase = Purchase::where(['id' => $id])->where('store_id', Auth::user()->getUserStoreId())->first();
        $inwards = $purchase->inwards;
        return view('admin.purchase.viewpurchase', compact('purchase', 'inwards', 'request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suppliers = User::getSuppliers(false);
        $purchase = Purchase::where(['id' => $id])->where('store_id', Auth::user()->getUserStoreId())->first();
        if(!$purchase) {
            abort(404);
        }
        elseif (strtolower($purchase->status) != 'in progress') {
            return back()->with(['error' => 'This order is in progress, so you have no access to edit this']);
        }
        return view('admin.purchase.editpurchase', compact('suppliers', 'purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $request->validate([
            'supplier' => 'required',
            'purchase_date' => 'required|date',
            'supplier_date' => 'required|date',
            'refrence_number' => 'required|max:255,unique,purchases',
            'sku_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'required' => 'payment_type'
        ]);

        // if($request->grand_total < $request->amount_paid) {
        //     $error['errors']['amount_paid'] = 'Paid amount is invalid';
        //     return response()->json($error, 422);
        // }
        // DB::beginTransaction();
        try {
            $purchase = Purchase::where(['id' => $id])->where('store_id', Auth::user()->getUserStoreId())->first();

            $purchase->purchaseItems()->delete();
            $data = $request->only(['purchase_date', 'refrence_number', 'note', 'supplier_date']);
            // $data['total_amount_paid'] = $request->amount_paid;
            $data['supplier_id'] = $request->supplier;
            $purchase->update($data);
            
            $input = $request->all();
            $total_purchase_item = 0;
            $total_item = 0;
            for($row = 0; $row < count($input['sku_id']); $row++) {
                $sku = ProductSku::find($input['sku_id'][$row]);
                $product_id = $sku->product_id;
                $total = ((float) $input['unit_price'][$row]* (float)$input['quantity'][$row]) + ($input['tax_amount'][$row]* $input['quantity'][$row]);
                $purchase_item_data = ['purchase_id' => $purchase->id, 
                                        'product_id' => $product_id, 
                                        'sku_id' => $input['sku_id'][$row], 
                                        'quantity' =>  $input['quantity'][$row], 
                                        'pending_quantity' =>  $input['quantity'][$row], 
                                        'unit_price' =>  $input['unit_price'][$row], 
                                        'total_price' => $total, 
                                        'unit_tax' => $input['tax_amount'][$row], 
                                        'margin' => $sku->mrp - $input['unit_price'][$row], 
                                        'mrp' => $sku->mrp,
                                        'purchase_tax' => $sku->product->purchase_tax,
                                        'sale_price' =>  $sku->price];
                $total_purchase_item += (float) $purchase_item_data['total_price'];
                $total_item += $input['quantity'][$row];
                $purchase_item = PurchaseItem::create($purchase_item_data);
                
            }
            $due_amount = $total_purchase_item-$purchase->total_amount_paid;
            $purchase->total_amount = $total_purchase_item;
            $purchase->total_quantity = $total_item;
            $purchase->due_amount = $due_amount;
         
            $purchase->save();
    
            // $transaction = InventoryTransaction::create(['note' => $request->note, 'linkable_type' => 'purchase', 'linkable_id' => $purchase->id, 'total_amount' =>  $purchase->total_amount, 'paid_amount' => $total_purchase_item, 'due_amount' => $purchase->due_amount, 'created_by' => Auth::id()]);
            DB::commit();
            // $error['errors']['error'] = json_encode($purchase);
            // return response()->json($error, 500);
            Session::flash('success', 'Purchase Details successfully added');
            return response(['status' => 'success' , 'url' => route('admin.purchase.index')]);
    
        }
        catch(Exception $exception) {
            DB::rollback();
            $error['errors']['error'] = $exception->getMessage();
            return response()->json($error, 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $purchase = Purchase::where(['id' => $id, 'store_id' => User::getUserStoreId()])->first();
      
        if(!$purchase) {
            abort(404);
        }
        if(strtolower($request->type == 'delete')) {
            if (strtolower($purchase->status) != 'in progress') {
                return back()->with(['error' => 'This order is in progress, so you have no access to delete this']);
            }
            else {
                $purchase->purchaseItems()->delete();
                $purchase->delete();
                Session::flash('success', 'Purchase Order successfully delete.');
                return response(['status' => 'success']);
    
            }
        }
        else if(strtolower($request->type == 'cancel')) {
            if (strtolower($purchase->status) != 'in progress') {
                return back()->with(['error' => 'This order is in progress, so you have no access to cancel this']);
            }
            else {
                $purchase->status = 'cancelled';
                $purchase->save();
                Session::flash('success', 'Purchase Order successfully cancelled.');
                return response(['status' => 'success']);
    
            }
        }
    }

    public function getPurchaseItem(Request $request)
    {
        $sku = ProductSku::find($request->product_id);
        $data = view('admin.purchase.purchase_product', compact('sku'))->render();
        return response(['data' => $data]);
    }

    
    public function importIndex()
    {
        $suppliers = User::orderBy('id', 'desc')->where('type', 'supplier')->get();

       return view('admin.purchase.importpurchase', compact('suppliers'));
    }


    public function importProduct(Request $request)
    {
        $request->validate([
            'purchase_date' => 'required|date',
            'supplier' => 'required',
            'refrence_number' => 'required',
            'file' => 'required'
        ]);
        Excel::import(new PurchaseImport($request->supplier, $request->purchase_date, $request->refrence_number, $request->amount_paid, $request->payment_type, $request->note), $request->file('file')->store('temp'));
        Session::flash('success', 'Purchase imported successfully');
        return response(['status' => 'success' , 'url' => route('admin.import-purchase.data')]);
    }

    public function purchaseTransaction(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'purchase_id' => 'required',
            'amount_paid' => 'required|numeric',
            'payment_type' => 'required'
        ]);
        $purchase = Purchase::where('id', $request->purchase_id)->first();
        if($purchase) {
            if($purchase->due_amount < $request->amount_paid) {
                $error['errors']['amount_paid'] = 'Paid amount is invalid';
                return response()->json($error, 422);
            }
    
        }
        $due_amount = $purchase->due_amount-$request->amount_paid;
        $transaction = InventoryTransaction::create(['note' => $request->note, 'linkable_type' => 'purchase', 'linkable_id' => $purchase->id, 'total_amount' =>  $purchase->due_amount, 'paid_amount' => $request->amount_paid, 'due_amount' => $due_amount, 'created_by' => Auth::id(), 'payment_type' => $request->payment_type, 'transaction_date' => $request->transaction_date]);
   
        $purchase->total_amount_paid = $purchase->total_amount-$due_amount;
        $purchase->due_amount = $due_amount;
        if($due_amount == 0 ) {
            $purchase->payment_status = 'paid';
        }
        elseif($due_amount == $purchase->total_amount) {
            $purchase->payment_status = 'unpaid';
        }
        elseif($due_amount < $purchase->total_amount) {
            $purchase->payment_status = 'partial';
        }
        $purchase->save();
        DB::commit();
        Session::flash('success', 'Purchase Transaction  successfully added');
        return response(['status' => 'success']);


    }


    public function returnIndex(Request $request)
    {
        $return_items = ReturnProduct::where('linkable_type', 'purchase')->where('quantity', '>', 0)->orderBy('id', 'desc');
      
       
       
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
       return view('admin.purchase.purchasereturnlist', compact('request', 'return_items'));
    }

    public function returnCreate(Request $request)
    {
        $purchase = [];
        if(isset($request->reference_number) && !empty($request->reference_number)) {

            $purchase = Purchase::where(['refrence_number' => $request->reference_number])->first();
        }
       return view('admin.purchase.createpurchasereturn', compact('request', 'purchase'));
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
            $order_item = PurchaseItem::find($item);
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
                $return_item = ReturnProduct::where(['linkable_type' => 'purchase',
                                                    'item_id' => $item,
                                                    'return_date' => $request->return_date,
                                                    'type' => $type,
                                                    'note' => $request->note,
                                                    'payment_type' => $request->payment_type])
                                                    ->first();
                if(!$return_item)  {
                    $return_item = new ReturnProduct();
                    $return_item->linkable_type = 'purchase';
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
        Session::flash('success', 'Purchase return successfully added');
        return response(['status' => 'success' , 'url' => route('admin.purchase.return.index')]);



    }

    public function returnEdit($return_id)
    {
        $item = ReturnProduct::where(['linkable_type' => 'purchase', 'id' => $return_id])->first();
        return view('admin.purchase.editpurchasereturn', compact('item'));
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

                if($return_item->purchaseItem) {
                    $item = $return_item->purchaseItem;
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
        Session::flash('success', 'Purchase return  successfully updated');
        return response(['status' => 'success' , 'url' => route('admin.purchase.return.index')]);



    }


    public function purchaseReport(Request $request)
    {
        return view('admin.purchase.purchasereport');
    }

    
    public function getPayments($order_id)
    {
        $transactions = InventoryTransaction::where(['linkable_type' => 'purchase', 'linkable_id' => $order_id, 'created_by' => Auth::id()])->orderBy('id', 'desc')->get();
        $purchase = Purchase::find($order_id);
        return view('admin.supplier.payments', compact('transactions', 'purchase'));
    }


    public function invoicePdf($id) {
        $purchase = Purchase::find($id);
        // return view('admin.purchase.invoice');
        $html = view('admin.purchase.invoice', compact('purchase'))->render();
        $pdf = Pdf::loadHtml($html);
        return $pdf->stream('invoice.pdf');


    }


}
