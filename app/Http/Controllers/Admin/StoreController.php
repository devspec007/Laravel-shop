<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Models\ProductInventory;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->where('type', 'store');
        if(isset($request->name) && !empty($request->name)) {
            $users->where('name', 'like', '%'.$request->name.'%');
        }
        if(isset($request->email) && !empty($request->email)) {
            $users->where('email', 'like', '%'.$request->email.'%');
        }
        if(isset($request->contact) && !empty($request->contact)) {
            $users->where('contact', 'like', '%'.$request->contact.'%');
        }
        if(isset($request->status) && !empty($request->status)) {
            $users->where('status', $request->status);
        }
        $users = $users->paginate(10);
        $states = Place::where('type', 'state')->get();
        $cities = [];
        if($request->state) {
            $cities = Place::where('type', 'city')->where('p_id', $request->state)->get();

        }
        return view('admin.store.storelist', compact('request', 'users', 'cities', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = Place::where('type', 'state')->get();

        return view('admin.store.addstore', compact('states'));
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
            'city' => 'required',
            'state' => 'required',
            'password' => 'required|min:6|max:12',
            'commission' => 'required|min:0|max:100'
        ]);
        $image = '';
        $data = $request->only(['name', 'email', 'contact']);
        $data['password'] = bcrypt($request->password);
        $data['type'] = 'store';
        $data['created_by'] = Auth::id();
        $user = User::create($data);
        if($user) {

            $user_profile = new UserProfile();
            $user_profile->user_id = $user->id;
            $user_profile->description = $request->description;
            $user_profile->state_id = $request->state;
            $user_profile->city_id = $request->city;
            $user_profile->address = $request->address;
            $user_profile->commission = $request->commission;

            if ($request->image) {
    
                $fileName = time() . '.' . $request->image->extension();
                $path = 'uploads/user/' . date('y/m');
                $request->image->move($path, $fileName);
                $image = $path . '/' . $fileName;
                $user_profile->image = $image;
            }
            $user_profile->save();

        }
        
        Session::flash('success', 'Store is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.store.index')]);
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
        $user = User::where(['id' => $id, 'type' => 'store'])->first();
        if($user) {

            return view('admin.store.editstore', compact('user', 'states'));
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
            'city' => 'required',
            'state' => 'required',
            'password' => 'nullable|min:6|max:12',
            'commission' => 'required|min:0|max:100'


        ]);
        $user = User::find($id);
        $image = '';
        $data = $request->only(['name', 'email', 'contact', 'status']);
        if (!empty($request->password)) {

            $data['password'] = bcrypt($request->password);
        }
        $data['type'] = 'store';
        $user->update($data);
        if($user) {

            $user_profile = UserProfile::where('user_id', $user->id)->first();
            $user_profile->description = $request->description;
            $user_profile->state_id = $request->state;
            $user_profile->city_id = $request->city;
            $user_profile->address = $request->address;
            $user_profile->commission = $request->commission;
            if ($request->image) {
    
                $fileName = time() . '.' . $request->image->extension();
                $path = 'uploads/user/' . date('y/m');
                $request->image->move($path, $fileName);
                $image = $path . '/' . $fileName;
                $user_profile->image = $image;
            }
            $user_profile->save();

        }
        
        Session::flash('success', 'Store is updated successfully');
        return response(['status' => 'success' , 'url' => route('admin.store.index')]);
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
        Session::flash('success', 'Store successfully deleted');
        return response(['status' => 'success']);
    }

    public function inventoryIndex(Request $request, $store_id)
    {
        $inventories = ProductInventory::where('store_id', $store_id);

        $inventories = $inventories->get();
        return view('admin.store.inventory.index', compact('inventories', 'request'));
    }
}
