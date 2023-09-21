<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempOrder;
use Illuminate\Http\Request;
use Auth;
class TempOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = TempOrder::orderBy('created_at', 'desc');
        if(Auth::user()->type == 'store') {
            $orders->where('store_id', Auth::user()->getUserStoreId());
        }
       
        if(isset($request->start_date) && !empty($request->start_date)) {
            $orders->wheredate('order_date', '>=' ,$request->start_date);
        }
        if(isset($request->end_date) && !empty($request->end_date)) {
            $orders->wheredate('order_date', '<=' ,$request->end_date);
        }
        
        $orders = $orders->paginate(20);
        return view('admin.temp_order.index', compact('request', 'orders'));
    }

    public function create()
    {
        $order = [];
        return view('admin.temp_order.add', compact('order'));
    }

    public function store(Request $request)
    {
      
    }
}
