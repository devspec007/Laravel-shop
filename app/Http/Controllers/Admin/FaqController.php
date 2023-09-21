<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Session;
class FaqController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:faq-list|faq-add|faq-edit|faq-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:faq-add', ['only' => ['create','store']]);
        // $this->middleware('permission:faq-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:faq-delete', ['only' => ['destroy']]);
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = Faq::paginate(20);
        return view('admin.faq.list', compact('faqs', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.add');
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
            'question' => 'required',
            'answer' => 'required',
        ]);
        $data = $request->only(['answer', 'question']);
        $faq = Faq::create($data);
        Session::flash('success', 'Faq is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.faqs.index')]);
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
        $faq = Faq::find($id);
        if(!$faq) {
            abort(404);
        }

        return view('admin.faq.edit', compact('faq'));
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
            'question' => 'required',
            'answer' => 'required',
        ]);
        $faq = Faq::find($id);
        $data = $request->only(['question', 'answer']);
        $faq->update($data);
        Session::flash('success', 'Faq is updated successfully');
        return response(['status' => 'success', 'url' => route('admin.faqs.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();
        Session::flash('success', 'Faq successfully deleted');
        return response(['status' => 'success']);
    }

}
