<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerFollowup;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
class FolloweUpController extends Controller
{
    public function index(Request $request) {
        $orders = Order::orderBy('created_at', 'desc')->where('order_type', 'order');
        if(Auth::user()->type == 'store') {
            $orders->where('store_id', Auth::user()->getUserStoreId());
        }
       if (isset($request->filter_type) && !empty($request->filter_type)) {
            $orders->whereHas('lastFollowup', 
            function($q) use ($request) {

                    if($request->filter_type=='notes')
                    {
                        if (isset($request->start_date) && !empty($request->start_date)) {
                            return $q->whereDate('notes_date',  '>=', $request->start_date);
                        }
                        if (isset($request->end_date) && !empty($request->end_date)) {
                            return $q->whereDate('notes_date',  '<=', $request->end_date);
                        }
                    }
        
                    if($request->filter_type=='pickup')
                    {
                        if (isset($request->start_date) && !empty($request->start_date)) {
                            return $q->whereDate('pickup_date',  '>=', $request->start_date);
                        }
                        if (isset($request->end_date) && !empty($request->end_date)) {
                            return $q->whereDate('pickup_date',  '<=', $request->end_date);
                        }
                    }
            });
       }
       else{
            $orders->with("lastFollowup");
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

        // if(isset($request->start_date) && !empty($request->start_date)) {
        //     $orders->wheredate('order_date', '>=' ,$request->start_date);
        // }
        // if(isset($request->end_date) && !empty($request->end_date)) {
        //     $orders->wheredate('order_date', '<=' ,$request->end_date);
        // }
        $orders->groupBy('orders.id');
        $orders = $orders->select('orders.*')->paginate(10);
        return view('admin.customer.followup.index', compact('orders', 'request'));
        // $orders->orderBy('customer_followup.id', 'desc');

    }


     /**
     * Save customer follow-up.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_notes(Request $request)
    {
        $order = Order::where('order_number',  $request->order_id)->first();
        $customer_follow =new CustomerFollowup();
        $customer_follow->user_id = $request->user_id;
        $customer_follow->order_id = $request->order_id;
        $customer_follow->notes = $request->notes;
        $customer_follow->pickup_date = $request->pickup_date;
        $customer_follow->notes_date = date('Y-m-d');
        $customer_follow->save();

        return back()->with('success','Notes saved successfully');
    }

    public function view_notes(Request $request)
    {   
    $customer_follow =CustomerFollowup::where('order_id', $request->order_id)->orderBy('id','desc')->get();
        $order = Order::select('order_number')->find($request->order_id);
        return view('admin.customer.followup.followupNotes',compact('customer_follow','order'));
    }
}
