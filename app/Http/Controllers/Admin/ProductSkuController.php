<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductSku;
use App\Models\ProductSkuOption;
use App\Models\User;
use App\Models\VariantAttribute;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
class ProductSkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id, Request $request)
    {
        $skus = ProductSku::where('product_id', $product_id);

        $skus = $skus->paginate(10);
        $product = Product::find($product_id);

        return view('admin.sku.multiple_variant_product', compact('product', 'skus'));
        // return response(['data' => $data]);


        // return view('admin.sku.list', compact('skus', 'product_id', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = Product::find($product_id);
        $product_variant_attribute_ids = [];
        if($product->variantOptions) {
            $product_variant_attribute_ids = array_column(($product->variantOptions)->toArray(), 'variant_id');
        }
        $attributes = VariantAttribute::whereIn('id', $product_variant_attribute_ids)->get();
        $stores = User::orderBy('id', 'desc')->whereIn('type', ['store', 'admin'])->get();

        return view('admin.sku.add', compact('product_id', 'attributes', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($product_id, Request $request)
    {
        $validations = ['sku' => 'required|max:255|unique:product_skus,sku', 'mrp' => 'nullable|numeric'];
        
        if(!empty($request->discount_type)) {

            $validations = array_merge($validations, [
                'discount_start_date' => 'required|date',
                'discount_end_date' => 'required|date',
                'discount' => 'required|numeric',
    
            ]);
           
        }
        if(!empty($request->wholesale_discount_type)) {

            $validations = array_merge($validations, [
                'wholesale_discount_start_date' => 'required|date',
                'wholesale_discount_end_date' => 'required|date',
                'wholesale_discount' => 'required|numeric',
    
            ]);
           
        }
        $request->validate($validations);
        
        $data = $request->only(['sku', 'minimum_quantity', 'quantity','discount', 'price', 'discount_type', 'discount_end_date', 'discount_start_date', 'wholesale_discount', 'wholesale_price', 'wholesale_discount_type', 'wholesale_discount_end_date', 'wholesale_discount_start_date', 'mrp']);
        $data['enable_for_wholesale'] = $request->wholesale_status;
        $data['enable_for_customer'] = $request->customer_status;

        if(empty($request->discount_type)) {
            $data['discount'] = 0;
            $data['discount'] = 0;
            $data['discount_start_date'] = null;
            $data['discount_end_date'] = null;
            $data['regular_price'] = $request->price;
        }
        elseif($request->discount_type == 1) {
            $data['regular_price'] = $request->price - $request->discount;
        }
        elseif($request->discount_type == 2) {
            $discounted_price =  $request->price - (($request->discount/100)*$request->price);
            $data['regular_price'] = $request->price - $discounted_price;
        }
        // whole sale discount
        if(empty($request->wholesale_discount_type)) {
            $data['wholesale_discount'] = 0;
            $data['wholesale_discount_start_date'] = null;
            $data['wholesale_discount_end_date'] = null;
            $data['wholesale_regular_price'] = $request->wholesale_price;
        }
        elseif($request->discount_type == 1) {
            $data['wholesale_regular_price'] = $request->wholesale_price - $request->wholesale_discount;
        }
        elseif($request->discount_type == 2) {
            $discounted_price =  $request->wholesale_price - (($request->wholesale_discount/100)*$request->wholesale_price);
            $data['wholesale_regular_price'] = $request->wholesale_price - $discounted_price;
        }


        // $data = $request->only(['sku', 'minimum_quantity', 'quantity', 'tax', 'discount', 'price']);
        // $data['regular_price'] = $request->price;
        $data['product_id'] = $product_id;
        $sku = ProductSku::create($data);
        if($request->hasFile('images')){
            $files = $request->file('images');
            for($i=0; $i<count($files); $i++){
                $img = new Media();
                $name = rand().'.'.$files[$i]->getClientOriginalExtension();
                $files[$i]->move('uploads/products/',$name);
                $img->image = $name;
                $img->linkable_id = $sku->id;
                $img->linkable_type = 'product-variant';
                if($i == 0) {
                    $img->is_primary = 1;
                }
                else {
                    $img->is_primary = 0;
                }
                $img->sequance = $i+1;
                $img->save();
            }
           
        }

        $input = $request->all();
        if(isset($request->attribute)) {
            for($i = 0; $i< count($request->attribute); $i++) {
                if(!empty($input['attribute'][$i]) && !empty($input['option'][$i])) {

                    $product_option = new ProductSkuOption();
                    $product_option->sku_id = $sku->id;
                    $product_option->attribute_id = $input['attribute'][$i];
                    $product_option->attribute_value = $input['option'][$i];
                    $product_option->attribute_type = 'filter';

                    $product_option->save();

                }

            }
        }

        // if($request->update_inventory == 'yes') {

            // $inventory = ProductInventory::create(['store_id' => $request->store, 
            // 'unit_price' => $request->purchase_price, 
            // 'quantity' => $request->quantity,
            // 'sale_price' => $request->sale_price, 
            // 'product_id' => $product_id, 
            // 'left_quantity' => $request->quantity,
            // 'sku_id' => $sku->id]);
            
            $tax =  ($sku->price*$sku->product->purchase_tax)/100;
            $inventory = ProductInventory::create(['store_id' => Auth::user()->getUserStoreId(), 
            'quantity' => $request->quantity,
            'product_id' => $sku->product_id, 
            'left_quantity' => $request->quantity,
            'sku_id' => $sku->id,
            'unit_price' =>  $sku->price,  
            'mrp' => $sku->mrp, 
            'purchase_tax' => $sku->product->purchase_tax, 
            'unit_tax' =>$tax, 

        ]);
        
        // }

        Session::flash('success', 'SKU is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.sku.index',[$product_id])]);

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
    public function edit($product_id, $id)
    {
        $sku = ProductSku::find($id);
        $product = Product::find($product_id);
        $product_variant_attribute_ids = [];
        if($product->variantOptions) {
            $product_variant_attribute_ids = array_column(($product->variantOptions)->toArray(), 'variant_id');
        }
        $attributes = VariantAttribute::whereIn('id',$product_variant_attribute_ids)->get();
   
        return view('admin.sku.edit', compact('product_id', 'attributes', 'sku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $id)
    {
        
        $validations = ['sku' => 'required|max:255|unique:product_skus,sku,'.$id, 'mrp' => 'nullable|numeric'];
        
        if(!empty($request->discount_type)) {

            $validations = array_merge($validations, [
                'discount_start_date' => 'required|date',
                'discount_end_date' => 'required|date',
                'discount' => 'required|numeric',
    
            ]);
           
        }
        if(!empty($request->wholesale_discount_type)) {

            $validations = array_merge($validations, [
                'wholesale_discount_start_date' => 'required|date',
                'wholesale_discount_end_date' => 'required|date',
                'wholesale_discount' => 'required|numeric',
    
            ]);
           
        }
        $request->validate($validations);
        

        
        $sku = ProductSku::where('id', $id)->first();
        $data = $request->only(['sku', 'minimum_quantity', 'quantity','discount', 'price', 'discount_type', 'discount_end_date', 'discount_start_date', 'wholesale_discount', 'wholesale_price', 'wholesale_discount_type', 'wholesale_discount_end_date', 'wholesale_discount_start_date', 'mrp']);
        $data['enable_for_wholesale'] = $request->wholesale_status;
        $data['enable_for_customer'] = $request->customer_status;

        if(empty($request->discount_type)) {
            $data['discount'] = 0;
            $data['discount_start_date'] = null;
            $data['discount_end_date'] = null;
            $data['regular_price'] = $request->price;
        }
        elseif($request->discount_type == 1) {
            $data['regular_price'] = $request->price - $request->discount;
        }
        elseif($request->discount_type == 2) {
            $discounted_price =  (($request->discount/100)*$request->price);
            $data['regular_price'] = $request->price - $discounted_price;
        }
        // whole sale discount
        if(empty($request->wholesale_discount_type)) {
            $data['wholesale_discount'] = 0;
            $data['wholesale_discount_start_date'] = null;
            $data['wholesale_discount_end_date'] = null;
            $data['wholesale_regular_price'] = $request->wholesale_price;
        }
        elseif($request->discount_type == 1) {
            $data['wholesale_regular_price'] = $request->wholesale_price - $request->wholesale_discount;
        }
        elseif($request->discount_type == 2) {
            $discounted_price =   (($request->wholesale_discount/100)*$request->wholesale_price);
            $data['wholesale_regular_price'] = $request->wholesale_price - $discounted_price;
        }
      
        $sku->update($data);
        if($request->hasFile('images')){
            $files = $request->file('images');
            for($i=0; $i<count($files); $i++){
                $img = new Media();
                $name = rand().'.'.$files[$i]->getClientOriginalExtension();
                $files[$i]->move('uploads/products/',$name);
                $img->image = $name;
                $img->linkable_id = $sku->id;
                $img->linkable_type = 'product-variant';
                if($i == 0) {
                    $img->is_primary = 1;
                }
                else {
                    $img->is_primary = 0;
                }
                $img->sequance = $i+1;
                $img->save();
            }
           
        }

        // ProductSkuOption::where(['sku_id' =>  $sku->id])->delete();
        // $input = $request->all();
        // if(isset($request->attribute)) {
        //     for($i = 0; $i< count($request->attribute); $i++) {

        //         if(!empty($input['attribute'][$i]) && !empty($input['option'][$i])) {

        //             $product_option = new ProductSkuOption();
        //             $product_option->sku_id = $sku->id;
        //             $product_option->attribute_id = $input['attribute'][$i];
        //             $product_option->attribute_value = $input['option'][$i];
        //             $product_option->attribute_type = 'filter';

        //             $product_option->save();

        //         }

        //     }
        // }
       
        Session::flash('success', 'SKU is updated successfully');
        return response(['status' => 'success' , 'url' => route('admin.sku.index',[$sku->product_id])]);

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

    public function getSkuDetails(Request $request)
    {
        $sku = ProductSku::find($request->id);
        return response(['data' => $sku]);
    }


    public function addMultipleVariants(Request $request, $product_id) {
        DB::beginTransaction();
        $product = Product::find($product_id);
        for($count = 0; $count < count($request->sku); $count++) {
            $sku_data = ['sku' => $request['sku'][$count],
                                        'minimum_quantity' => $request['minimum_qty'][$count],
                                        'mrp' => $request['mrp'][$count], 
                                        'purchase_price' => $request['purchase_price'][$count], 
                                        'discount' => $request['customer_discount'][$count],
                                        'price' => (float)$request['customer_price'][$count],
                                        'selling_margin' => (float)$request['customer_margin'][$count],
                                        'retailer_discount' => $request['retailer_discount'][$count],
                                        'retailer_price' => (float)$request['retailer_price'][$count],
                                        'retailer_margin' => (float)$request['retailer_margin'][$count],
                                        'wholesale_discount' => $request['wholesale_discount'][$count],
                                        'wholesale_price' => (float)$request['wholesale_price'][$count],
                                        'wholesale_margin' => (float)$request['wholesale_margin'][$count],
                                        'landing_cost' => (float)$request['landing_cost'][$count],
                                        'quantity' => $request['opening_qty'][$count],

                                    ];
            // return response(['data' => $sku_data], 422);
                        
            $sku_data['product_id'] = $product->id;
            
            $sku = ProductSku::create($sku_data);
            foreach($product->variantOptions as $varaint) {
                $product_option = new ProductSkuOption();
                $product_option->sku_id = $sku->id;
                $product_option->attribute_id = $varaint->attribute_id;
                $product_option->attribute_value = $request['option_'.$varaint->attribute_id][$count];
                $product_option->attribute_type = 'filter';

                $product_option->save();
            }

            // $inventory = ProductInventory::create(['store_id' => User::getUserStoreId(), 
            // 'quantity' => $request['opening_qty'][$count],
            // 'product_id' => $sku->product_id, 
            // 'left_quantity' =>$request['opening_qty'][$count],
            // 'sku_id' => $sku->id]);

                
            $tax =  ($sku->price*$sku->product->purchase_tax)/100;
            $inventory = ProductInventory::create(['store_id' => Auth::user()->getUserStoreId(), 
            'quantity' => $request['opening_qty'][$count],
            'product_id' => $sku->product_id, 
            'left_quantity' => $request['opening_qty'][$count],
            'sku_id' => $sku->id,
            'unit_price' =>  $sku->price,  
            'mrp' => $sku->mrp, 
            'purchase_tax' => $sku->product->purchase_tax, 
            'unit_tax' =>$tax, 

        ]);
            

        }
        DB::commit();
        Session::flash('success', 'SKU is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.sku.index',[$product->id])]);
    }

    public function updateMultipleVariants(Request $request, $product_id) {
        DB::beginTransaction();
        $product = Product::find($product_id);
        for($count = 0; $count < count($request->sku); $count++) {
         
            $sku_data = ['sku' => $request['sku'][$count],
                                        'minimum_quantity' => $request['minimum_qty'][$count],
                                        'mrp' => $request['mrp'][$count], 
                                        'purchase_price' => $request['purchase_price'][$count], 
                                        'discount' => $request['customer_discount'][$count],
                                        'price' => (float)$request['customer_price'][$count],
                                        'selling_margin' => (float)$request['customer_margin'][$count],
                                        'retailer_discount' => $request['retailer_discount'][$count],
                                        'retailer_price' => (float)$request['retailer_price'][$count],
                                        'retailer_margin' => (float)$request['retailer_margin'][$count],
                                        'wholesale_discount' => $request['wholesale_discount'][$count],
                                        'wholesale_price' => (float)$request['wholesale_price'][$count],
                                        'wholesale_margin' => (float)$request['wholesale_margin'][$count],
                                        'landing_cost' => (float)$request['landing_cost'][$count],
                                    ];

            $sku_data['product_id'] = $product->id;
            
            $sku = ProductSku::where('id', $request['sku_key'][$count])->first();
            
            $sku->update($sku_data);
            foreach($product->variantOptions as $varaint) {
                // return response([ 'errors' => $varaint], 422);
                $product_option = ProductSkuOption::where(['sku_id' => $sku->id, 'attribute_id' => $varaint->attribute_id])->first();
                if(!$product_option) {

                    $product_option = new ProductSkuOption();
                    $product_option->sku_id = $sku->id;
                    $product_option->attribute_id = $varaint->attribute_id;
                }
                $product_option->attribute_value = $request['option_'.$varaint->attribute_id][$count];
                $product_option->attribute_type = 'filter';

                $product_option->save();
            }

            // $inventory = ProductInventory::where(['store_id' => User::getUserStoreId(), 
            // 'product_id' => $sku->product_id, 
            // 'sku_id' => $sku->id])->first();
            // if(!$inventory) {

            //     $inventory = ProductInventory::create(['store_id' => User::getUserStoreId(), 
            //     'quantity' => $request['opening_qty'][$count],
            //     'product_id' => $sku->product_id, 
            //     'left_quantity' =>$request['opening_qty'][$count],
            //     'sku_id' => $sku->id]);
            // }
            // else {
            //     $inventory->update([
            //         'quantity' => $request['opening_qty'][$count],
            //     'left_quantity' =>$request['opening_qty'][$count] >=  $inventory->left_quantity ? $request['opening_qty'][$count] : $inventory->left_quantity,
            //     ]);
            // }
            

        }
        DB::commit();
        Session::flash('success', 'SKU is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.sku.index',[$product->id])]);
    }
}
