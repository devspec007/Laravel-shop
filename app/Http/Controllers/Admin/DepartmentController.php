<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use Auth;
class DepartmentController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:department-list|department-add|department-edit|department-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:department-add', ['only' => ['create','store']]);
        // $this->middleware('permission:department-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:department-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::orderBy('id', 'desc');
        if(isset($request->name) && !empty($request->name)) {
            $departments->where(function($query) use($request) {

                $query->where('name', 'like', '%'.$request->name.'%');
            });
        }
       
        if(isset($request->status) && !empty($request->status)) {
            $departments->where('status', $request->status);
        }
        $departments = $departments->paginate(10);
        return view('admin.department.list', compact('departments', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.department.add');
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
            'name' => 'required|unique:departments|max:255',
            

        ]);
        $data = $request->only(['name']);
        $data['created_by'] = Auth::id();
      
        $data['slug'] = Str::slug($request->name);
        $department = Department::create($data);
        Session::flash('success', 'Department is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.department.index')]);
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
        $department = Department::find($id);
        if(!$department) {
            abort(404);
        }
      
        return view('admin.department.edit', compact('department'));
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
            'name' => 'required|max:255|unique:departments,name,'.$id,
           

        ]);
        $department = Department::find($id);
        if(!$department) {
            return response(['status' => 'error' , 'message' => 'Department not found']);
            
        }
        
        $data = $request->only(['name','status']);
        $data['created_by'] = Auth::id();
       
        $data['slug'] = Str::slug($request->name);
        $brand = $department->update($data);
        Session::flash('success', 'Department is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.department.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        Session::flash('success', 'Department successfully deleted');
        return response(['status' => 'success']);
    }

    

    
}
