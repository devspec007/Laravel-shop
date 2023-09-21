<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Session;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pages = Page::orderBy('id', 'desc');
        $pages = $pages->paginate(10);

        return view('admin.pages.list', compact('pages', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.add');

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
            'slug' => 'required|unique:pages|max:255',
            'page_description' => 'required',
            'name' => 'required|max:255'

        ]);
        $image = '';
        $data = $request->only([ 'slug','meta_title','meta_keywords','meta_description']);
        $data['type'] = $request->name;
        $data['description'] = $request->page_description;
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/pages/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $page = Page::create($data);
        Session::flash('success', 'Page is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.pages.index')]);
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
        $page = Page::where('id',$id)->first();
        if(!$page) {
            abort(404);
        }
        $page_data = $page;
        return view('admin.pages.edit', compact('page_data'));
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
            'slug' => 'required|max:255|unique:pages,slug,'.$id,
            'page_description' => 'required',
            'name' => 'required|max:255'

        ]);
        $data = $request->only(['slug','meta_title','meta_keywords','meta_description']);
        $data['type'] = $request->name;

        $data['description'] = $request->page_description;

        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/pages/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $data['image'] = $image;
        }
        $page = Page::where('id', $id)->update($data);
        Session::flash('success', 'Page is update successfully');
        return response(['status' => 'success' , 'url' => route('admin.pages.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Page::find($id);
        $category->delete();
        Session::flash('success', 'Page successfully deleted');
        return response(['status' => 'success']);
    }
}
