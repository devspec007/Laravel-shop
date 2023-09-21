<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Session;
class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $places = Place::orderBy('id', 'desc')->where('type', 'state');
        if(isset($request->search) && !empty($request->search)) {
            $places->where('name', 'like', '%'.$request->search.'%');
        }
        $places = $places->paginate(10);
        return view('admin.place.statelist', compact('request', 'places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.place.newstate');
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

        ]);
        $data = $request->only(['name']);
        $data['type'] = 'state';
       
        $brand = Place::create($data);
        Session::flash('success', 'State is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.state.index')]);
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
        $place = Place::where(['id' => $id, 'type' => 'state'])->first();
        return view('admin.place.editstate',compact('place'));
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
            'name' => 'required|max:255|unique:places,name,'.$id,

        ]);
        $place = Place::find($id);
        $data = $request->only(['name']);
        $data['type'] = 'state';
       
        $place->update($data);
        Session::flash('success', 'State is updated successfully');
        return response(['status' => 'success' , 'url' => route('admin.state.index')]);
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
}
