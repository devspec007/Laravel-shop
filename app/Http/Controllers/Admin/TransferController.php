<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TransferImport;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductSku;
use App\Models\Transfer;
use App\Models\TransferItem;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transfers = Transfer::orderBy('id', 'desc')
        ->where(function($query) {
            $query->where('from_store', Auth::user()->getUserStoreId());
            // ->orwhere('to_store', Auth::user()->getUserStoreId());
        });
        if(isset($request->from_store) && !empty($request->from_store)) {
            $transfers->where('from_store', $request->from_store);
        }
        if(isset($request->to_store) && !empty($request->to_store)) {
            $transfers->where('to_store', $request->to_store);
        }

        if(isset($request->start_date) && !empty($request->start_date)) {
            $transfers->wheredate('transfer_date', '>=' ,$request->start_date);
        }
        if(isset($request->end_date) && !empty($request->end_date)) {
            $transfers->wheredate('transfer_date', '<=' ,$request->end_date);
        }
        // if(isset($request->payment_status) && !empty($request->payment_status)) {
        //     $transfers->wherein('payment_status',$request->payment_status);
        // }
        $transfers = $transfers->paginate(20);
        $main_store = User::orderBy('id', 'desc')->whereIn('type', ['admin'])->first();

        $stores = User::orderBy('id', 'desc')->where('type', 'store')->get();
        return view('admin.transfer.transferlist', compact('request', 'transfers', 'main_store', 'stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_store = User::orderBy('id', 'desc')->whereIn('type', ['admin'])->first();
        $stores = User::orderBy('id', 'desc')->whereIn('type', ['store', 'admin'])->get();
        return view('admin.transfer.addtransfer', compact('stores', 'main_store'));
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
            'transfer_date' => 'required|date',
            'from_store' => 'required',
            'to_store' => 'required',
            'inventory_id' => 'required',
            'quantity' => 'required',
            // 'payment_type' => 'required',
            // 'amount_paid' => 'required|numeric'
        ]);

        if($request->to_store == $request->from_store) {
            $error['errors']['to_store'] = 'From and to store shuold be different';
            return response()->json($error, 422);
        }

        if($request->grand_total < $request->amount_paid) {
            $error['errors']['amount_paid'] = 'Paid amount is invalid';
            return response()->json($error, 422);
        }

        $data = $request->only(['transfer_date', 'to_store', 'from_store', 'note']);
        // $data['total_amount_paid'] = $request->amount_paid;
        $data['created_by'] = Auth::id();
        $purchase = Transfer::create($data);
        $input = $request->all();
        $total_purchase_item = 0;
        $total_item = 0;
        for($row = 0; $row < count($input['inventory_id']); $row++) {
            $inventory = ProductInventory::where('id', $input['inventory_id'][$row])->first();
            if($inventory) {

                $total = (float) $input['unit_price'][$row]* (float)$input['quantity'][$row];
                $purchase_item_data = ['inventory_id' => $inventory->id , 'transfer_id' => $purchase->id, 'product_id' => $inventory->product_id, 'sku_id' => $inventory->sku_id, 'quantity' =>  $input['quantity'][$row], 'unit_price' =>  $input['unit_price'][$row], 'total_price' => $total];
                $total_purchase_item += (float) $purchase_item_data['total_price'];
                $total_item += $input['quantity'][$row];
                // return response(['status' => 'success' , 'url' => $purchase_item_data ], 422);
                $purchase_item = TransferItem::create($purchase_item_data);
                $inventory_data = ['store_id' => $request->to_store, 
                                    'product_id' => $inventory->product_id, 
                                    'sku_id' => $inventory->sku_id,
                                    'unit_price' =>  $inventory->unit_price,  
                                    'mrp' => $inventory->mrp, 
                                    'purchase_tax' => $inventory->purchase_tax, 
                                    'unit_tax' =>$inventory->unit_tax, 
                                ];
                $check_inventory = ProductInventory::where($inventory_data)->first();

                if(!$check_inventory) {
                    $inventory_data = array_merge($inventory_data, ['quantity' =>  $input['quantity'][$row], 'left_quantity' => $input['quantity'][$row]]);
                    // $inventory_data = ['product_purchase_id' => $purchase_item->id,
                    // 'sku_id' => $inventory->sku_id, 'store_id' => $request->to_store, 'product_id' => $inventory->product_id,  'quantity' =>  $input['quantity'][$row], 'left_quantity' => $input['quantity'][$row], 'unit_price' =>  $input['unit_price'][$row], 'total_price' => $total];
                    ProductInventory::create($inventory_data);
                }
                else {
                    $check_inventory->quantity =  $input['quantity'][$row]+$check_inventory->quantity;
                    $check_inventory->left_quantity =  $input['quantity'][$row]+$check_inventory->left_quantity;
                    $check_inventory->total_price = $check_inventory->quantity*$check_inventory->unit_price;
                    $check_inventory->save();

                }
                $inventory->left_quantity = $inventory->left_quantity-(float)$input['quantity'][$row];
                $inventory->save();

            }

        }
        $purchase->transfer_id = 'Trans-'.$purchase->id;
        $purchase->total_amount_paid = $total_purchase_item;
        $due_amount = $total_purchase_item-$purchase->total_amount_paid;
        $purchase->total_amount = $total_purchase_item;
        $purchase->total_quantity = $total_item;
        $purchase->due_amount = $due_amount;
        // if($due_amount == 0 ) {
        //     $purchase->payment_status = 'paid';
        // }
        // elseif($due_amount == $total_purchase_item ) {
        //     $purchase->payment_status = 'unpaid';
        // }
        // elseif($due_amount < $total_purchase_item ) {
        //     $purchase->payment_status = 'partial';
        // }
        $purchase->save();

        $transaction = InventoryTransaction::create(['linkable_type' => 'transfer', 'linkable_id' => $purchase->id, 'total_amount' =>  $purchase->total_amount, 'paid_amount' => $purchase->total_amount_paid, 'due_amount' => $purchase->due_amount, 'created_by' => Auth::id()]);
       
        DB::commit();
        Session::flash('success', 'Stock Transfer successfully added');
        return response(['status' => 'success' , 'url' => route('admin.transfer.index')]);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $transfer = Transfer::where('id',$id)->where('from_store', Auth::user()->getUserStoreId())->first();
       return view('admin.transfer.showtransfer', compact('transfer'));
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

    public function getTransferItem(Request $request)
    {

        $inventory = ProductInventory::where('id', $request->inventory_id)
                        // ->where('product_inventories.store_id', $request->store_id)
                        ;
        // $sku = ProductSku::where('id', $request->sku_id);

        $inventory = $inventory->select('product_inventories.*')->first();

        $data = view('admin.transfer.tranfer_product', compact('inventory'))->render();
        return response(['data' => $data]);
       
    }

    public function importIndex()
    {
        $main_store = User::orderBy('id', 'desc')->whereIn('type', ['admin'])->first();
        $stores = User::orderBy('id', 'desc')->whereIn('type', ['store', 'admin'])->get();

       return view('admin.transfer.importtransfer', compact('main_store', 'stores'));
    }

    public function importProduct(Request $request)
    {
        $request->validate([
            'transfer_date' => 'required|date',
            'from_store' => 'required',
            'to_store' => 'required',
            'file' => 'required',
            // 'payment_type' => 'required',
            // 'amount_paid' => 'required|numeric'
        ]);
        Excel::import(new TransferImport($request->transfer_date, $request->to_store, $request->from_store, $request->note), $request->file('file')->store('temp'));
        Session::flash('success', 'Purchase imported successfully');
        return response(['status' => 'success' , 'url' => route('admin.import-transfer.data')]);

    }
}
