<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Session;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'desc');
       
        $roles = $roles->paginate(50);
        // print_r( auth()->user()->getRoleNames());
        return view('admin.role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.role.add');
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
            'name' => 'required|unique:roles|max:255',
            

        ]);
        $data = $request->only(['name']);
      
        $data['guard_name'] ='web';
        $role = Role::create($data);
        Session::flash('success', 'ROle is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.role.index')]);
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
        $role = Role::find($id);
        if(!$role) {
            abort(404);
        }
      
        return view('admin.role.edit', compact('role'));
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
            'name' => 'required|max:255|unique:roles,name,'.$id,
           

        ]);
        $role = Role::find($id);
        if(!$role) {
            return response(['status' => 'error' , 'message' => 'Role not found']);
            
        }
        $role->syncPermissions($request->permission);

        
        $data = $request->only(['name']);
        $role->update($data);
        Session::flash('success', 'Role is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.role.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        Session::flash('success', 'Role successfully deleted');
        return response(['status' => 'success']);
    }

}
