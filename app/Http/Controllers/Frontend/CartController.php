<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductSku;
use App\Models\ProductSkuOption;
use Illuminate\Http\Request;
use Cart;
use Auth;
use Session;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

            $product_id = $request->variant_id;
            $term = ProductSku::where('id',$product_id);
            if(Auth::check() && strtolower(Auth::user()->type) == 'distributor') {
                $term->select('product_skus.id', 'product_skus.product_id', 'product_skus.wholesale_price as price', 'product_skus.wholesale_discount as discount')->with('productAttributes');
            }
            else {
                $term->select('product_skus.id', 'product_skus.product_id', 'product_skus.price as price', 'product_skus.discount as discount')->with('productAttributes');
    
    
            }
            $term = $term->first();

            $image_url = '';
            if( $term->product && $term->product->primaryImage) {
                $image_url = asset('uploads/products/'.$term->product->primaryImage->image);
            }
            $product_name = $term->product->productFullName();
    
            $options = ProductSkuOption::with('attribute')->where('sku_id', $product_id )->groupBy('attribute_id')->groupBy('attribute_value')->orderBy('attribute_id')->get();
        
            

            Cart::instance('frontend_order')->add($term->id, $product_name, 1, $term->price, 0, [ 'product_id' => $term->product_id, 'sku' => $term->sku, 'preview' => $image_url, 'options' => $options, 'sku_details' =>$term]);
            $data = view('admin.sales.cart_list')->render();
            $subtotal = Cart::instance('frontend_order')->subtotal();
            $total = Cart::instance('frontend_order')->total();
            $quantity = Cart::instance('frontend_order')->count();
            $mini_cart = view('frontend.component.mini_card')->render();
            return response(['data' => $data, 'mini_cart' => $mini_cart, 'subtotal' => $subtotal, 'total' => $total, 'quantity' => $quantity, 'message' => 'Cart successfully added']);
        
       
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        foreach($request->cart_id as $key => $cart_id) {
            $qty = $input['quantity'][$key];
            Cart::instance('frontend_order')->update( $cart_id, $qty );

        }
        Session::flash('success',  'Cart successfully added');
        return response([ 'message' => 'Cart successfully added']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::instance('frontend_order')->remove($id);
        Session::flash('success',  'Cart successfully update');
        return response([ 'message' => 'Cart successfully added']);
    }
}
