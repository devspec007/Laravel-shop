<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Session;

class CityController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $places = Place::orderBy('id', 'desc')->where('type', 'city');
        if(isset($request->search) && !empty($request->search)) {
            $places->where('name', 'like', '%'.$request->search.'%');
        }
        $places = $places->paginate(10);
        return view('admin.place.citylist', compact('request', 'places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = Place::where(['type' => 'state'])->get();
        return view('admin.place.newcity', compact('states'));
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
            'name' => 'required|unique:places|max:255',
            'state' => 'required',

        ]);
        $data = $request->only(['name']);
        $data['type'] = 'city';
        $data['p_id'] = $request->state;
       
        $place = Place::create($data);
        Session::flash('success', 'City is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.city.index')]);
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
        $states = Place::where(['type' => 'state'])->get();

        $place = Place::where(['id' => $id, 'type' => 'city'])->first();
        return view('admin.place.editcity',compact('place', 'states'));
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

        ]);

        
        $check_place = Place::where(['name' => $request->name, 
                                        'p_id' => $request->state,
                                        'type' => 'city'])->first();
        if($check_place) {
            $error['errors']['name'] = 'This product is already exist';
            return response()->json($error, 422);
        }

        $place = Place::find($id);
        $data = $request->only(['name']);
        $data['type'] = 'city';
        $data['p_id'] = $request->state;
       
        $place->update($data);
        Session::flash('success', 'City is updated successfully');
        return response(['status' => 'success' , 'url' => route('admin.city.index')]);
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
