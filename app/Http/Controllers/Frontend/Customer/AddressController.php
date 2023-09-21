<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Place;
use Illuminate\Http\Request;
use Auth;
use Session;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = CustomerAddress::where(['user_id' => Auth::id()])->orderBy('id', 'desc')->get();
        return view('frontend.customer.address.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = Place::where('type', 'state')->get();

        return view('frontend.customer.address.create', compact('states'));
        
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
            'pincode' => 'required|numeric|digits:6',
            'phone_no' => 'required|numeric|digits:10',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only(['name', 'phone_no', 'address', 'area', 'pincode']);
        $data['state_id'] = $request->state;
        $data['city_id'] = $request->city;
        $data['user_id'] = Auth::id();
        CustomerAddress::create($data);
        Session::flash('success', 'Address is successfully added');
        return response(['status' => 'success']);

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
        $states = Place::where('type', 'state')->get();
        $address = CustomerAddress::find($id);
        return view('frontend.customer.address.edit', compact('states', 'address'));
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
            'pincode' => 'required|numeric|digits:6',
            'phone_no' => 'required|numeric|digits:10',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only(['name', 'phone_no', 'address', 'area', 'pincode', 'status']);
        $data['state_id'] = $request->state;
        $data['city_id'] = $request->city;
        $data['user_id'] = Auth::id();
        CustomerAddress::where('id', $id)->update($data);
        Session::flash('success', 'Address is successfully updated');
        return response(['status' => 'success']);
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
    public function filterCity(Request $request)
    {
       $cities = Place::where(['p_id' => $request->state_id, 'type' => 'city'])->get();
       return response(['cities' => $cities]);
    }
}
