<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnitType;
use Illuminate\Http\Request;
use Session;
use Auth;
class UnitTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:unit-type-list|unit-type-add|unit-type-edit|unit-type-delete', ['only' => ['index','show']]);
        $this->middleware('permission:unit-type-add', ['only' => ['create','store']]);
        $this->middleware('permission:unit-type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:unit-type-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unit_types = UnitType::orderBy('id', 'desc');
        if(isset($request->name) && !empty($request->name)) {
            $unit_types->where(function($query) use($request) {

                $query->where('name', 'like', '%'.$request->name.'%');
            });
        }
       
        if(isset($request->status) && !empty($request->status)) {
            $unit_types->where('status', $request->status);
        }
        $unit_types = $unit_types->paginate(10);
        return view('admin.unittype.list', compact('unit_types', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.unittype.add');
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
            'name' => 'required|unique:unit_types|max:255',
            

        ]);
        $data = $request->only(['name']);
        $data['created_by'] = Auth::id();
      
        $unit = UnitType::create($data);
        Session::flash('success', 'Unit Type is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.unit-type.index')]);
        // return redirect()->route('admin.category.index');

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
        $unit_type = UnitType::find($id);
        if(!$unit_type) {
            abort(404);
        }
      
        return view('admin.unittype.edit', compact('unit_type'));
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
            'name' => 'required|max:255|unique:unit_types,name,'.$id,
           

        ]);
        $unit = UnitType::find($id);
        if(!$unit) {
            return response(['status' => 'error' , 'message' => 'Unit Type not found']);
            
        }
        
        $data = $request->only(['name','status']);
        $data['created_by'] = Auth::id();
       
        $unit = $unit->update($data);
        Session::flash('success', 'Unit Type is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.unit-type.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UnitType::find($id);
        $data->delete();
        Session::flash('success', 'Unit Type successfully deleted');
        return response(['status' => 'success']);
    }

}
