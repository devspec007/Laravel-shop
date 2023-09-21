<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aPermission=DB::table('role_has_permissions')
        ->where('role_id',$id)
        ->pluck('permission_id')->toArray();

        
        $permissions = Permission::get();

        $permission_list=[];
        foreach($permissions as $row){
            $is_permission=in_array($row->id,$aPermission) ? 1 : 0;
            array_push($permission_list,array("id" =>(string)$row->id, "parent" =>($row->parent==0) ? '#': (string)$row->parent  , "text" => $row->title,
                'state'       => array(
                    'opened'    => 1,
                    'disabled'  => 0,
                    'selected'  =>$is_permission
                ),'icon'=> "fa fa-lock"
            ));
        }
        $role = Role::find($id);
        $permissions = Permission::whereNull('parent_id')->get();
        return view('admin.role.edit', compact('permissions', 'role', 'aPermission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $role=Role::find($id);
        $role->syncPermissions($request->permission);
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
