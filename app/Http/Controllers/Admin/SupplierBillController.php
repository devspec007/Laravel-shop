<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\PurchaseInward;
use App\Models\PurchaseInwardItem;
use App\Models\ShippingBill;
use App\Models\ShippingBillItem;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Session;
use Exception;
use Auth;
class SupplierBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ShippingBill::getList(true, $request);
        return view('admin.purchase.supplier-bill.bill_list', compact('list', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = User::getSuppliers(false);
        
        return view('admin.purchase.supplier-bill.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'supplier' => 'required',
            'supply_date' => 'required|date',
            'amount_paid' => 'required|numeric|max:'.$request->total_amount,
            'shipping_date' => 'required|date',
            'inward' => 'required',
            'payment_type' => 'required'
        ]);
        $validations = [];
        if($request->payment_type == 'online') {
            array_merge($validations, [
                'bank' => 'required'
            ]);

            if($request->type == 'online') {
                array_merge($validations, [
                    'transaction_date' => 'required|date',
                    'transaction_no' => 'required'
                ]);
            }
            else {
                array_merge($validations, [
                    'cheque_date' => 'required|date',
                    'cheque_no' => 'required'
                ]);
            }
        }

        if(count($validations) > 0 ) {
            $request->validate($validations);
        }
        
        

        try {
            $data = $request->only(['supply_date', 'shipping_date', 'note', 'payment_type']);
            $data['inward_id'] = $request->inward;
            $data['supplier_id'] = $request->supplier;
            $data['store_id'] = User::getUserStoreId();
            $data['created_by'] = auth()->user()->id;

            $bill = ShippingBill::create($data);
            $input = $request->all();
            $total_amount = 0;
            $total_item = 0;
            for($row = 0; $row < count($input['item_id']); $row++) {
                $inward_item = PurchaseInwardItem::find($input['item_id'][$row]);
               
                
                $item = ['shipping_bill_id' => $bill->id, 
                                'purchase_item_id' => $inward_item->purchase_item_id, 
                                'inward_item_id' => $inward_item->id, 
                                'sku_id' => $inward_item->sku_id, 
                                'quantity' => $inward_item->received_quantity , 
                                'pending_amount' => $inward_item->received_quantity*$inward_item->purchaseItem->unit_price,
                                'amount' => $inward_item->received_quantity*$inward_item->purchaseItem->unit_price

                            ];
                $total_amount = $total_amount+($inward_item->received_quantity*$inward_item->purchaseItem->unit_price);
                ShippingBillItem::create($item);
              
                $inward_item->pending_amount = 0;
                $inward_item->save();
              
            }
           

            $bill->bill_no = 'BILL'.$bill->id;
            $bill->total_amount = $total_amount;
            $bill->pending_amount =  $total_amount - $request->amount_paid;
            $bill->paid_amount = $request->amount_paid;
            if($bill->pending_amount == 0 ) {
                $bill->payment_status = 'paid';
            }
            elseif($bill->pending_amount == $bill->total_amount) {
                $bill->payment_status = 'unpaid';
            }
            elseif($bill->pending_amount < $bill->total_amount) {
                $bill->payment_status = 'partial';
            }
            // $bill->payment_status = 'complete';
            $bill->save();

            $additional_data = $request->only(['payment_type',  'type', 'bank', 'cheque_date', 'cheque_no', 'transaction_date', 'transaction_no']);
            $transaction = InventoryTransaction::create(['note' => $request->note, 'linkable_type' => 'supplier-bill', 'linkable_id' => $bill->id, 'total_amount' =>  $bill->total_amount, 'paid_amount' => $request->amount_paid, 'due_amount' =>  $bill->pending_amount, 'created_by' => Auth::id(), 'additional_data' => json_encode(($additional_data))]);
            
    
            DB::commit();
           
            Session::flash('success', 'Supplier Bill successfully added');
            return response(['status' => 'success' , 'url' => route('admin.supplier-bills.index')]);
    
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

     
     public function supplierBillDetails($id, $type = null)
     {
         $bill = ShippingBill::find($id);
        return view('admin.purchase.supplier-bill.show', compact('bill', 'type'));
     }
 
    public function show($id, $type = null)
    {
        $bill = ShippingBill::find($id);
       return view('admin.purchase.supplier-bill.show', compact('bill', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function supplierBillTransaction(Request $request) {
        $request->validate([
            // 'transaction_date' => 'required|date',
            'bill_id' => 'required',
            'amount_paid' => 'required|numeric',
            'payment_type' => 'required'
        ]);

        if($request->payment_type == 'online') {
          
            $request->validate([
                'bank' => 'required'
            ]);

            if($request->type == 'online') {
               
                $request->validate([
                    'transaction_date' => 'required|date',
                    'transaction_no' => 'required'
                ]);
            }
            else {
                $request->validate([
                    'cheque_date' => 'required|date',
                    'cheque_no' => 'required'
                ]);
             
            }
        }

        
        
        $bill = ShippingBill::where('id', $request->bill_id)->first();
        if($bill) {
            if($bill->pending_amount < $request->amount_paid) {
                $error['errors']['amount_paid'] = 'Paid amount is invalid';
                return response()->json($error, 422);
            }
    
        }
        $due_amount = $bill->pending_amount-$request->amount_paid;
        
   
        $bill->paid_amount = $bill->total_amount-$due_amount;
        $bill->pending_amount = $due_amount;
        if($due_amount == 0 ) {
            $bill->payment_status = 'paid';
        }
        elseif($due_amount == $bill->total_amount) {
            $bill->payment_status = 'unpaid';
        }
        elseif($due_amount < $bill->total_amount) {
            $bill->payment_status = 'partial';
        }
        $bill->save();
        $additional_data = $request->only(['payment_type', 'type', 'bank', 'cheque_date', 'cheque_no', 'transaction_date', 'transaction_no']);
        $transaction = InventoryTransaction::create(['note' => $request->note, 'linkable_type' => 'supplier-bill', 'linkable_id' => $bill->id, 'total_amount' =>  $bill->total_amount, 'paid_amount' => $request->amount_paid, 'due_amount' =>  $bill->pending_amount, 'created_by' => Auth::id(), 'additional_data' => json_encode(($additional_data))]);
        

        DB::commit();
        Session::flash('success', 'Purchase Transaction  successfully added');
        return response(['status' => 'success']);
    }
}
