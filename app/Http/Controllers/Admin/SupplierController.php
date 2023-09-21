<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\Purchase;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Traits\UserTrait;
use Exception;
use App\Traits\StockTrait;


class SupplierController extends Controller
{
    use UserTrait;
    use StockTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::getSuppliers(true, $request);
        $states = Place::getStates();
        $cities = [];
        if($request->state) {
            $cities = Place::where('type', 'city')->where('p_id', $request->state)->get();

        }
        return view('admin.supplier.supplierlist', compact('request', 'users', 'states', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = Place::getStates();
        return view('admin.supplier.addsupplier', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'email' => 'required|email|unique:users',
            'contact' => 'required|numeric|digits:10|unique:users',
            // 'city' => 'required',
            'state' => 'required',
            'password' => 'required|min:6|max:12',
        ]);
        try {
            // throw new Exception('This Offset already exist');
            $this->createUpdateSupplier($request);
            Session::flash('success', 'Supplier is added successfully');
            return response(['status' => 'success' , 'url' => route('admin.supplier.index')]);
        }
        catch(Exception $exception) {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = Place::getStates();
        $user = User::where(['id' => $id, 'type' => 'supplier'])->first();
        if($user) {
            $additional_data = [];
            if($user->additional_data != null) {
                $additional_data = json_decode($user->additional_data, true);
            }
            return view('admin.supplier.editsupplier', compact('user', 'states', 'additional_data'));
        }
        abort(404);
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
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'email' => 'required|email|unique:users,email,'.$id,
            'contact' => 'required|numeric|digits:10|unique:users,contact,'.$id,
            'state' => 'required',
            'password' => 'nullable|min:6|max:12',
        ]);
        try {
            // throw new Exception('This Offset already exist');
            $this->createUpdateSupplier($request, $id);
            Session::flash('success', 'Supplier is updated successfully');
            return response(['status' => 'success' , 'url' => route('admin.supplier.index')]);
        }
        catch(Exception $exception) {
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
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'Supplier successfully deleted');
        return response(['status' => 'success']);
    }

    public function supplierReport(Request $request)
    {
        $purchases = Purchase::where('due_amount', '>', 0)->get();
        return view('admin.supplier.supplierreport', compact('purchases'));
    }
}
