<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\VariantAttribute;
use Illuminate\Http\Request;
use Auth;
use Session;

class AttributeController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:attribute-list|attribute-add|attribute-edit|attribute-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:attribute-add', ['only' => ['create','store']]);
        // $this->middleware('permission:attribute-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:attribute-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attributes = VariantAttribute::orderBy('id', 'desc');
        if(isset($request->search) && !empty($request->search)) {
            $attributes->where(function($query) use($request) {

                $query->where('lable', 'like', '%'.$request->search.'%');
            });
        }
       
        if(isset($request->status) && !empty($request->status)) {
            $attributes->where('status', $request->status);
        }
        $attributes = $attributes->paginate(10);
        return view('admin.attribute.list', compact('attributes', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attribute.add');
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
            'lable' => 'required|unique:attributes|max:255',
            'options' => 'required',

        ]);
        $data = $request->only(['lable', 'options']);
        $data['created_by'] = Auth::id();
        
        $attribute = VariantAttribute::create($data);
        Session::flash('success', 'Attribute is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.attribute.index')]);
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
        $attribute = VariantAttribute::find($id);
        if(!$attribute) {
            abort(404);
        }
        return view('admin.attribute.edit', compact('attribute'));
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
            'lable' => 'required|max:255|unique:attributes,lable,'.$id,
            'options' => 'required',

        ]);
        $attribute = VariantAttribute::find($id);
        if(!$attribute) {
            return response(['status' => 'error' , 'message' => 'Brand not found']);
            
        }
       
        $data = $request->only(['lable', 'options', 'status']);
        
        $attribute = $attribute->update($data);
        Session::flash('success', 'Attribute is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.attribute.index')]);
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

    public function filterAttribute(Request $request)
    {
        $attribute = VariantAttribute::where('id',$request->attribute_id)->first();
        $data = [];
        if($attribute)  {
            $data = explode(',', $attribute->options);
        }
        return response(['options' => $data, 'attribute' => $attribute->options]);
    }
}
