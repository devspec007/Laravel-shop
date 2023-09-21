<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adminmenu;
use Illuminate\Http\Request;
use DB;
class FrontendMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
        $menus= Adminmenu::latest()->get();

        $positions=MenuPositions();
        return view('admin.mega_menu.create',compact('menus','positions'));
    }

    public function create()
    {
        return view('admin.mega_menu.index');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        if ($request->status==1) {
            if ($request->position == 'header') {
                DB::table('adminmenus')->where('position',$request->position)->update(['status'=>0]);
            }   
        }
        $men=new Adminmenu;
        $men->name=$request->name;
        $men->position=$request->position;
        $men->status=$request->status;
        $men->data="[]";
        $men->save();

        return back()->with(['success' => 'Menu Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $info= Adminmenu::find($id);

        return view('admin.mega_menu.index',compact('info'));
    }

    /*
    update menus json row in  menus table
    */
    public function MenuNodeStore(Request $request)
    {
       
        $info= Adminmenu::find($request->menu_id);
        $info->data=$request->data;
        $info->save();

        return back()->with(['success' => 'Menu Updated']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $info= Adminmenu::find($id);
       $positions=MenuPositions();

       return view('admin.mega_menu.edit',compact('info','positions'));
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
       
        if ($request->status==1) {
            if ($request->position == 'header') {
                DB::table('adminmenus')->where('position',$request->position)->update(['status'=>0]);
            }
        }

        $men= Adminmenu::find($id);
        $men->name=$request->name;
        $men->position=$request->position;
        $men->status=$request->status;
        $men->save();
        return back()->with(['success' => 'Menu Updated']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy(Request $request)
        {
           
            if ($request->method=='delete') {
             if ($request->ids) {
                foreach ($request->ids as $id) {
                 Adminmenu::destroy($id);
               }
             }
            }

        return response()->json(['Menu Removed']);
        }

        public function uploadMedia(Request $request)
        {
            if($request->hasFile('images')){
                $files = $request->file('images');
                for($i=0; $i<count($files); $i++){
                    $name = rand().'.'.$files[$i]->getClientOriginalExtension();
                    $files[$i]->move('uploads/media/',$name);
                   
                }
            }
            return back()->with(['success' => 'Images successfully uploaded']);
        }
}
