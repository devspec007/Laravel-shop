<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use Auth;
class SubCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:subcategory-list|subcategory-add|subcategory-edit|subcategory-delete', ['only' => ['index','show']]);
        $this->middleware('permission:subcategory-add', ['only' => ['create','store']]);
        $this->middleware('permission:subcategory-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subcategory-delete', ['only' => ['destroy']]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'desc')->whereNotNull('p_id');
        if(isset($request->search) && !empty($request->search)) {
            $categories->where(function($query) use($request) {

                $query->where('name', 'like', '%'.$request->search.'%')
                ->orwhere('code', 'like', '%'.$request->search.'%');
            });
        }
        if(isset($request->status) && !empty($request->status)) {
            $categories->where('status', $request->status);
        }
        if(isset($request->parent) && !empty($request->parent)) {
            $categories->where('p_id', $request->parent);
        }
        $categories = $categories->paginate(10);
        $parent_categories = Category::orderBy('id', 'desc')->whereNull('p_id')->get();

        return view('admin.subcategory.subcategorylist', compact('categories', 'request', 'parent_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->whereNull('p_id')->get();

        return view('admin.subcategory.subaddcategory', compact('categories'));
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
            'code' => 'required|max:255|unique:categories',
            'image' => 'nuulable|mimes:jpeg,png,jpg,gif',
            'parent_id' => 'required'

        ]);
        $image = '';
        $data = $request->only(['name', 'code', 'description']);
        $data['created_by'] = Auth::id();
        $data['p_id'] = $request->parent_id;
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $data['slug'] = Str::slug($request->name);
        $category = Category::create($data);
        Session::flash('success', 'Category is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.sub-category.index')]);
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

        return view('admin.subcategory.editsubcategory', compact('category', 'categories'));
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
            'code' => 'required|max:255|unique:categories,name,'.$id,
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'parent_id' => 'required'

        ]);
        $category = Category::find($id);
        if(!$category) {
            return response(['status' => 'error' , 'message' => 'category not found']);
            
        }
        $image = '';
        $data = $request->only(['name', 'code', 'description', 'status']);
        // $data['created_by'] = Auth::id();
        $data['p_id'] = $request->parent_id;

        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $data['slug'] = Str::slug($request->name);
        $category = $category->update($data);
        Session::flash('success', 'Category is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.sub-category.index')]);
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
        Session::flash('success', 'Subcategory successfully deleted');
        return response(['status' => 'success']);
    }


    public function filterSubCategory(Request $request)
    {
       $categories = Category::where('p_id', $request->category_id)->get();
       return response(['categories' => $categories]);
    }
}
