<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\BrandImport;
use App\Models\Brand;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:brand-list|brand-add|brand-edit|brand-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:brand-add', ['only' => ['create','store']]);
        // $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::orderBy('id', 'desc');
        if(isset($request->search) && !empty($request->search)) {
            $brands->where(function($query) use($request) {

                $query->where('name', 'like', '%'.$request->search.'%')
                ->orwhere('code', 'like', '%'.$request->search.'%');
            });
        }
        if(isset($request->brand_name) && !empty($request->brand_name)) {
            $brands->where('name', 'like', '%'. $request->brand_name.'%');
        }
        if(isset($request->description) && !empty($request->description)) {
            $brands->where('description', 'like', '%'. $request->description.'%');
        }
        if(isset($request->status) && !empty($request->status)) {
            $brands->where('status', $request->status);
        }
        $brands = $brands->paginate(10);
        return view('admin.brand.brandlist', compact('brands', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::whereNull('parent_id')->get();
        return view('admin.brand.addbrand', compact('brands'));
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
            'name' => 'required|unique:brands|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',

        ]);
        $image = '';
        $data = $request->only(['name', 'code', 'description', 'parent_id']);
        $data['created_by'] = Auth::id();
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/brand/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $data['slug'] = Str::slug($request->name);
        $brand = Brand::create($data);
        Session::flash('success', 'Brand is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.brand.index')]);
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
        $brand = Brand::find($id);
        if(!$brand) {
            abort(404);
        }
        $brands = Brand::whereNull('parent_id')->get();

        return view('admin.brand.editbrand', compact('brand', 'brands'));
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
            'name' => 'required|max:255|unique:brands,name,'.$id,
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',

        ]);
        $brand = Brand::find($id);
        if(!$brand) {
            return response(['status' => 'error' , 'message' => 'brand not found']);
            
        }
        $image = '';
        $data = $request->only(['name', 'description', 'status', 'parent_id']);
        $data['created_by'] = Auth::id();
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $data['slug'] = Str::slug($request->name);
        $brand = $brand->update($data);
        Session::flash('success', 'Brand is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.brand.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();
        Session::flash('success', 'Brand successfully deleted');
        return response(['status' => 'success']);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        Excel::import(new BrandImport, $request->file('file')->store('temp'));
        Session::flash('success', 'Brand Import successfully');
        return back();
    }

    public function filterSubBrand(Request $request)
    {
       $brands = Brand::where('parent_id', $request->brand_id)->get();
       return response(['brands' => $brands]);
    }
    
}
