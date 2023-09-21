<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Session;
class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = ExpenseCategory::orderBy('id', 'desc');
        $list = $list->paginate(10);
        return view('admin.expense.expensecategory', compact('request', 'list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expense.addcategory');
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
        $data = $request->only(['name', 'description']);
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/brand/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $category = ExpenseCategory::create($data);
        Session::flash('success', 'Expense category is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.expense-category.index')]);
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
        $category = ExpenseCategory::find($id);
        return view('admin.expense.editcategory', compact('category'));
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
        $category = ExpenseCategory::find($id);
        if(!$category) {
            return response(['status' => 'error' , 'message' => 'category not found']);
            
        }
        $image = '';
        $data = $request->only(['name', 'description', 'status']);
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $category = $category->update($data);
        Session::flash('success', 'Category is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.expense-category.index')]);
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
