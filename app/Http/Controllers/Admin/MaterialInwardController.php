<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductInventory;
use App\Models\Purchase;
use App\Models\PurchaseInward;
use App\Models\PurchaseInwardItem;
use App\Models\PurchaseItem;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Session;
use Exception;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class MaterialInwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $inwards = PurchaseInward::getInwardList(true, $request);
        return view('admin.purchase.inward.inward_list', compact('inwards', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = User::getSuppliers(false);
        $employees = User::getEmployees(false);
        return view('admin.purchase.inward.create', compact('suppliers', 'employees'));
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
            'inward_date' => 'required|date',
            'purchase' => 'required',
        ]);

        try {
            $data = $request->only(['inward_date', 'note']);
            $data['purchase_id'] = $request->purchase;
            $data['supplier_id'] = $request->supplier;
            $data['receiver_id'] = $request->received_by;
            $data['store_id'] = User::getUserStoreId();
            $data['created_by'] = auth()->user()->id;

            $inward = PurchaseInward::create($data);
            $input = $request->all();
            $total_amount = 0;
            $total_item = 0;
            $tax_amount = 0;
            for($row = 0; $row < count($input['item_id']); $row++) {
                $purchase_item = PurchaseItem::find($input['item_id'][$row]);
                if($purchase_item->pending_quantity < $input['quantity'][$row]) {
                    $error['errors']['error'] = 'Received item are incorrect';
                    return response()->json($error, 422);
                }
                
                $item = ['inward_id' => $inward->id, 
                                'purchase_item_id' => $purchase_item->id, 
                                'sku_id' => $purchase_item->sku_id, 
                                'quantity' => $purchase_item->pending_quantity , 
                                'received_quantity' => $input['quantity'][$row],
                                'pending_amount' => $input['quantity'][$row]*$purchase_item->unit_price,
                                'amount' => $input['quantity'][$row]*$purchase_item->unit_price

                            ];
                $total_amount = ($total_amount+($input['quantity'][$row]*$purchase_item->unit_price))+($input['quantity'][$row]*$purchase_item->unit_tax);
                $tax_amount += ($input['quantity'][$row]*$purchase_item->unit_tax);
                PurchaseInwardItem::create($item);
                $received_quantity = $purchase_item->received_quantity+$input['quantity'][$row];
                $purchase_item->received_quantity = $received_quantity;
                $purchase_item->pending_quantity = $purchase_item->quantity - $received_quantity;
               
                $purchase_item->save();
                $inventory = ['product_purchase_id' => $purchase_item->id, 'store_id' => User::getUserStoreId(), 'product_id' => $purchase_item->product_id, 'sku_id' => $purchase_item->sku_id, 'quantity' =>  $input['quantity'][$row], 'left_quantity' => $input['quantity'][$row], 'unit_price' =>  $purchase_item->unit_price,  'mrp' => $purchase_item->mrp, 'purchase_tax' => $purchase_item->purchase_tax, 'unit_tax' => $purchase_item->unit_tax];
                $check_inventory = ProductInventory::where(['store_id' => User::getUserStoreId(), 'product_id' => $purchase_item->product_id, 'sku_id' => $purchase_item->sku_id, 'unit_price' =>  $purchase_item->unit_price,  'mrp' => $purchase_item->mrp, 'purchase_tax' => $purchase_item->purchase_tax, 'unit_tax' => $purchase_item->unit_tax])->first();
                if($check_inventory) {
                  
                    $check_inventory->quantity =  $check_inventory->quantity+$input['quantity'][$row];
                    $check_inventory->left_quantity =  $check_inventory->left_quantity+$input['quantity'][$row];
                    $check_inventory->save();
    
                }
                else {
    
                    ProductInventory::create($inventory);
                }
              
            }
            $purchase = Purchase::find($request->purchase);

            if(count($purchase->pendingPurchaseItems) > 0) {
                $purchase->status = 'partially delivered';
            }
            else {
                $purchase->status = 'delivered';

            }
            $purchase->save();

            $inward->inward_no = 'IN'.$inward->id;
            $inward->total_amount = $total_amount;
            $inward->pending_amount = $total_amount;
            $inward->tax_amount = $tax_amount;
            $inward->save();
            
    
            DB::commit();
           
            Session::flash('success', 'Inward Details successfully added');
            return response(['status' => 'success' , 'url' => route('admin.material-inward.index')]);
    
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
    public function show($id)
    {
        $inward = PurchaseInward::findById($id);
        return view('admin.purchase.inward.show', compact('inward'));
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

    

    public function invoicePdf($id) {
        $inward = PurchaseInward::find($id);
        // return view('admin.purchase.invoice');
        // print_r(json_encode($inward->inwardItems));
        // die;
        $html = view('admin.purchase.inward.invoice', compact('inward'))->render();
        $pdf = Pdf::loadHtml($html);
        return $pdf->stream('invoice.pdf');


    }

}
