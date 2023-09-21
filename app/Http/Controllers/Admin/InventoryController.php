<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$product_id = null)
    {
        $inventories = ProductInventory::getInventories(true, $request);
        $categories = Category::get();
        $brands = Brand::get();
        $subcategories = [];
        if(isset($request->category) && !empty($request->category)) {
            $subcategories = Category::where('p_id', $request->category)->get();
        }
        $stores = User::orderBy('id', 'desc')->whereIn('type', ['store', 'admin'])->get();

        return view('admin.inventory.index', compact('inventories', 'request', 'categories', 'brands', 'subcategories', 'product_id', 'stores'));
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = Product::find($product_id);
        $stores = User::orderBy('id', 'desc')->whereIn('type', ['store', 'admin'])->get();
        $html = view('admin.inventory.list', compact('product', 'stores'))->render();
        return view('admin.inventory.add', compact('product', 'stores', 'html'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $input = $request->all();
        for($i = 0; $i < count($request->store); $i++) {
            $data = ['store_id' => $input['store'][$i], 
            'unit_price' => $input['unit_price'][$i], 
            'quantity' => $input['quantity'][$i],
            'sale_price' => $input['sale_price'][$i], 
            'product_id' => $product_id, 
            'sku_id' => $input['sku'][$i]];
            $inventory = ProductInventory::where($data)->first();
            if(!$inventory) {
                $data['left_quantity'] = $input['quantity'][$i];
                $inventory = ProductInventory::create($data);
            }
            else {
                $inventory->quantity = $inventory->quantity+$input['quantity'][$i];
                $inventory->left_quantity = $inventory->left_quantity+$input['quantity'][$i];
                $inventory->save();
            }
           
        }
        Session::flash('success', 'Inventory Details successfully added');
        return response(['status' => 'success' , 'url' => route('admin.product-inventory',[$product_id])]);

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
        // echo $id;
        $inventory = ProductInventory::where('id', $id)->first();
        if($inventory) {
            return view('admin.inventory.edit', compact('inventory'));
        }
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
          
            'sale_price' => 'required|numeric',
        ]);

        $inventory = ProductInventory::where('store_id', Auth::id())->where('id', $id)->first();
        $inventory->sale_price = $request->sale_price;
        $inventory->save();
        Session::flash('success', 'Inventory Details successfully update');
        return response(['status' => 'success' , 'url' => route('admin.inventory.index')]);


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


    public function productInventoryForm($product_id)
    {
        $product = Product::find($product_id);
        $data = view('admin.inventory.list', compact('product'))->render();
        return response(['data' => $data]);
    }
}
