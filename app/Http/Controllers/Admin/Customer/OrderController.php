<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemInventory;
use App\Models\ProductInventory;
use Illuminate\Http\Request;
use PDF;
use DB;
use Session;
use Illuminate\Support\Facades\Http;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Auth;
class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->where('order_type', 'order');
        if(Auth::user()->type == 'store') {
            $orders->where('store_id', Auth::user()->getUserStoreId());
        }
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
        if(isset($request->payment_type) && !empty($request->payment_type)) {
            $orders->where('payment_type',$request->payment_type);
        }
        if(isset($request->delivery_type) && !empty($request->delivery_type)) {
            $orders->where('delivery_type',$request->delivery_type);
        }
        $orders = $orders->paginate(20);
        return view('admin.orders.index', compact('orders', 'request'));
    }

    public function show($order_id)
    {
        $order = Order::where(['id'=> $order_id])->where('order_type', 'order');
        if(Auth::user()->type == 'store') {
            $order->where('store_id', Auth::user()->getUserStoreId());
        }
        $order = $order->first();
        if(!$order) {
            abort(404);
        }
        if($order) {
            $billing_address = [];
            $shipping_address = [];
            if(!empty($order->billing_address)) {
                $billing_address = json_decode($order->billing_address);
            }
            if(!empty($order->shipping_address)) {
                $shipping_address = json_decode($order->shipping_address);
            }
            return view('admin.orders.details', compact('order', 'shipping_address', 'billing_address'));
        }
    }

    public function invoice($order_id)
    {
        $order = Order::where('id',$order_id)->where('order_type', 'order')->first();
        $pdf = PDF::loadView('admin.sales.invoice', ['order' => $order]);
        return $pdf->stream("invoice.pdf", array("Attachment" => false));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
            foreach($request->item as $index => $item) {
               $order_item = OrderItem::find($item);
               if($order_item) {
                
                    if(count($order_item->inventories) > 0) {

                        foreach($order_item->inventories as $inventory) {
                            $inventory_item = ProductInventory::find($inventory->inventory_id);
                            $inventory_item->update(['left_quantity' => $inventory_item->left_quantity+$inventory->quantity]);
                            $inventory->delete();
                        }
                    }
                    if(array_sum($request['quantity'.$item] ) > $order_item->quantity) {
                        $error['errors']['error'] = 'Invalid quanitty in row no. '.$index+1;
                        return response()->json($error, 422);
                    }
                    foreach($request['quantity'.$item] as $key => $item_quantity) {
                        if(!empty($item_quantity) && !empty($request['batch'.$item][$key])) {

                            $inventory = ProductInventory::find($request['batch'.$item][$key]);
                            if($inventory && $inventory->left_quantity < $item_quantity) {
                                $error['errors']['error'] = 'This batch no no item in row no '.$index+1;
                                return response()->json($error, 422);
                            }
                           if($inventory) {

                               OrderItemInventory::create([
                                   'order_item_id' => $item,
                                   'inventory_id' => $inventory->id , 
                                   'quantity' => $item_quantity, 
                                   'sale_price' => $order_item->amount, 
                                   'purchase_price' => $inventory->unit_price
                               ]);
                               $inventory->left_quantity = $inventory->left_quantity-$item_quantity;
                               $inventory->save();
                           }
                        }
                    }
               }
               
            }
            DB::commit();
            Session::flash('success', 'Order Item Successfully updated');
            return response(['status' => 'success']);
            // return back()->with(['success' => 'Inventory updated']);
        } catch (\Exception $th) {
            DB::rollback();
            Session::flash('error', 'Something went wrong');
            return repsonse(['status' => 'error']);
        }
    }

    public function edit(Request $request, $id)
    {
        $order = Order::find($id);

        //user manage as per order type
        $user = $order->user;
        if($order->order_type==0){
            $user_name=$user->name;
            $user_mobile=$user->mobile;
        }
        else{
            $user_name=$order->fullname;
            $user_mobile=$order->mobile;
        }
        
        if (isset($request->type) && $request->type == 'order_status') {
            $order->order_status = $request->status;
            //$user = $order->user;
            $message = '';
            if (strtolower($request->status) == 'delivered') {

                $order->is_delivered = 1;
                $message = 'Hi ' . $user_name . ', Your order ' . $order->order_no . ' has been successfully delivered. Team Saledepot.in MANI SALE INDIA';
            } elseif (strtolower($request->status) == 'cancelled') {
                $this->updateCancelOrderStock($order);

                $order->is_delivered = 0;
                $order->order_status_type = $request->order_status_type;
                $order->order_cancel_reason = $request->order_cancel_reason;
                $order->reorder_status = $request->reorder_status;
                $message = 'Hi ' . $user_name . ', Your order ' . $order->order_no . ' has been cancelled. We are sorry to see you go. Reach out us on Whatsapp to provide your valuable feedback. Team Saledepot.in MANI SALE INDIA';
            } else if (strtolower($request->status) == 'shipped') {
                $order->is_delivered = 0;
                $message = 'Hi ' . $user_name . ', Your order ' . $order->order_no . ' has been shipped! Track your shipment here: ' . $order->tracking_id . '. Team Saledepot.in MANI SALE INDIA';
            } else {
                $order->is_delivered = 0;

                $order->order_status_type = '';
                $order->order_cancel_reason = '';
                $order->reorder_status = '';
            }
            $order->cancel_reason = $request->cancel_reason;
            $order->payment_status = $request->payment_status;
            $order->collection_type = $request->collection_type;
            $order->order_transfer_status = 'intransit';

            $order->save();
            $this->sendSMS($message, $user_mobile);
            Session::flash('success', 'Successfully status changed');
            return response(['status' => 'success']);
        } else if (isset($request->type) && $request->type == 'approved_status') {

            $order->approved_status = $request->status;
            //$user = $order->user;
            $message = '';
            if (strtolower($request->status) == 'approved') {
                $order->order_status = 'confirmed';
                $order->reject_reason = null;
                $message = 'Hi ' . $user_name . ', Your order no. ' . $order->order_no . ' is accepted at Saledepot.in MANI SALE INDIA';
                // $this->courier($order->id);
                
            } else {
                // $this->updateCancelOrderStock($order);
                $order->order_status = 'canceled';
                $order->reject_reason = $request->reason;
                $message = 'Hi ' . $user_name . ', Your order no. ' . $order->order_no . ' is rejected at Saledepot.in MANI SALE INDIA';
            }
            $order->save();
            $this->sendSMS($message, $user_mobile);
            Session::flash('success', 'Successfully status changed');
            return response(['status' => 'success']);
        } else if(isset($request->type) && $request->type == 'transit_status'){
             
                $message = '';
                if (strtolower($request->order_transfer_status) == 'intransit') {
                    $order->order_transfer_status = 'intransit';
                } else {
                    $order->order_transfer_status = $request->order_transfer_status;
                }
                $order->save();
                Session::flash('success', 'Successfully Transfer status changed');
                return response(['status' => 'success']);
        } else {
            $order->is_delivered = 1;
        }
        $order->save();
        return back()->with('success', 'Successfully status changed');
    }
    
    private function refundAmount($order) {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

       $response = $api->payment->fetch($order->razorpay_id)->refund(array("amount"=> $order->total_amount, "speed"=>"normal", "notes"=>array("notes_key_1"=>$order->customer_name, "notes_key_2"=>$order->order_number), "receipt"=>$order->order_number));
   
        \Log::channel('payment_log')->info($order->order_number." order response".Carbon::now());
        \Log::channel('payment_log')->info(json_encode((array)$response));
    }

    private function updateCancelOrderStock($order) {
        foreach($order->items as $index => $order_item) {
            if($order_item) {
             
                if(count($order_item->inventories) > 0) {

                    foreach($order_item->inventories as $inventory) {
                         $inventory_item = ProductInventory::find($inventory->inventory_id);
                         $inventory_item->update(['left_quantity' => $inventory_item->left_quantity+$inventory->quantity]);
                         $inventory->delete();
                     }
                }
            }
        }
    }

    private function sendSMS($message, $number)
    {

        if (!empty($message)) {

            $response = Http::get('http://sms.osdigital.in/V2/http-api.php?apikey=aEWYH6QR7e6HRjHv&senderid=MANlSI&number=' . $number . '&message=' . $message . '&format=json');
        }
    }

}
