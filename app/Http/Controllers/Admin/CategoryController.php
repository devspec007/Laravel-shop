<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use Auth;
class CategoryController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:category-list|category-add|category-edit|category-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:category-add', ['only' => ['create','store']]);
        // $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'desc');
        if(isset($request->search) && !empty($request->search)) {
            $categories->where(function($query) use($request) {

                $query->where('name', 'like', '%'.$request->search.'%')
                ->orwhere('code', 'like', '%'.$request->search.'%');
            });
        }
        if(isset($request->deparment) && !empty($request->deparment)) {
            $categories->where('deparment_id', $request->deparment);
        }

        if(isset($request->parent) && !empty($request->parent)) {
            $categories->where('p_id', $request->parent);
        }
        if(isset($request->status) && !empty($request->status)) {
            $categories->where('status', $request->status);
        }
        $categories = $categories->paginate(10);
        $parent_categories = Category::orderBy('id', 'desc')->whereNull('p_id')->get();
        $departments = Department::get();

        return view('admin.category.categorylist', compact('categories', 'request', 'parent_categories', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->whereNull('p_id')->get();
        $departments = Department::get();
        return view('admin.category.addcategory', compact('categories', 'departments'));
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
            'name' => 'required|unique:categories|max:255',
            // 'code' => 'nullable|unique:categories|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'department' => 'required'

        ]);
        $image = '';
        $data = $request->only(['name', 'code', 'description']);
        $data['created_by'] = Auth::id();
        $data['p_id'] = $request->parent_id;
        $data['department_id'] = $request->department;
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        if(isset($request->is_popular) && !empty($request->is_popular)) {
            $data['is_popular'] =true;
        }
        else {
            $data['is_popular'] =false;

        }
        $data['slug'] = Str::slug($request->name);
        $category = Category::create($data);
        Session::flash('success', 'Category is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.category.index')]);
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
        $category = Category::find($id);
        if(!$category) {
            abort(404);
        }
        $categories = Category::orderBy('id', 'desc')->whereNull('p_id')->get();
        $departments = Department::get();

        return view('admin.category.editcategory', compact('category', 'categories', 'departments'));
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
            'name' => 'required|max:255|unique:categories,name,'.$id,
            // 'code' => 'required|max:255|unique:categories,code,'.$id,
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'department' => 'required'


        ]);
        $category = Category::find($id);
        if(!$category) {
            return response(['status' => 'error' , 'message' => 'category not found']);
            
        }
        $data['p_id'] = $request->parent_id;
        $image = '';
        $data = $request->only(['name', 'code', 'description', 'status']);
        $data['created_by'] = Auth::id();
        $data['department_id'] = $request->department;

        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        if(isset($request->is_popular) && !empty($request->is_popular)) {
            $data['is_popular'] =true;
        }
        else {
            $data['is_popular'] =false;

        }
        $data['slug'] = Str::slug($request->name);
        $category = $category->update($data);
        Session::flash('success', 'Category is added successfully');
        return response(['status' => 'success', 'url' => route('admin.category.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        Session::flash('success', 'Category successfully deleted');
        return response(['status' => 'success']);
    }
}
