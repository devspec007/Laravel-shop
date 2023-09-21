<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Session;
use Excetion;
use Auth;
class BannerController extends Controller
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
        $banners = Banner::bannerList(true, $request);
        return view('admin.banner.list', compact('banners', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.add');
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
            'alt_tag' => 'required|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'type' => 'required|max:255',
            'section' => 'required'

        ]);
        $image = '';
        $data = $request->only(['alt_tag', 'type', 'url', 'section']);
        $data['created_by'] = Auth::id();
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/banner/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['banner'] = $image;
        }
        $banner = Banner::create($data);
        Session::flash('success', 'Banner is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.banners.index')]);
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
        $banner = Banner::find($id);
        if(!$banner) {
            abort(404);
        }

        return view('admin.banner.edit', compact('banner'));
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
            'alt_tag' => 'required|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif',
            'type' => 'required|max:255',
            'section' => 'required'

        ]);
        $banner = Banner::find($id);
       
        $image = '';
        $data = $request->only(['alt_tag', 'type', 'url', 'section']);
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/banner/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['banner'] = $image;
        }
        $banner->update($data);
        Session::flash('success', 'Banner is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.banners.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Banner::find($id);
        $brand->delete();
        Session::flash('success', 'Banner successfully deleted');
        return response(['status' => 'success']);
    }

   
}
