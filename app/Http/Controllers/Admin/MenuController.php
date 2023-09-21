<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavMaster;
use Illuminate\Http\Request;
use Session;
class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus = NavMaster::orderBy('id', 'desc');
        
        $menus = $menus->get();
        return view('admin.navmaster.list', compact('menus', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = NavMaster::get();
        return view('admin.navmaster.add', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $data = $request->only(['name', 'parent_id', 'path', 'icons', 'permissions']);
       
        $menu = NavMaster::create($data);
        Session::flash('success', 'menu is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.menu.index')]);
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
        $menu = NavMaster::find($id);
        if(!$menu) {
            abort(404);
        }
        $menus = NavMaster::where('id', '<>', $id)->get();

        return view('admin.navmaster.edit', compact('menu', 'menus'));
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
       
        $menu = NavMaster::find($id);
        if(!$menu) {
            return response(['status' => 'error' , 'message' => 'menu not found']);
            
        }
       
        $data = $request->only(['name', 'parent_id', 'path', 'icons', 'permissions']);
        $menu = $menu->update($data);
        Session::flash('success', 'menu is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.menu.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = NavMaster::find($id);
        $menu->delete();
        Session::flash('success', 'menu successfully deleted');
        return response(['status' => 'success']);
    }

}
