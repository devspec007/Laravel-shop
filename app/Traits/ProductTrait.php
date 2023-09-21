<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductMeta;
use App\Models\ProductSku;
use App\Models\ProductVariantAttribute;
use App\Models\VariantAttribute;
use Auth;
use Exception;
use Illuminate\Support\Str;
use Session;
use DB;
use App\Models\Media;
use App\Models\ProductCategory;

trait ProductTrait
{
    public function createSimpleProduct($request) {
        $validations = [
            'name' => 'required|max:255|unique:products,name',
            'display_name' => 'required|max:255',
            'category' => 'required',
            'brand' => 'required',
            'sku' => 'required|max:255|unique:product_skus,sku',
            'purchase_tax' => 'required',
            'sale_tax' => 'required',
            'minimum_quantity' => 'required|numeric'
        ];
        $request->validate($validations );
        DB::beginTransaction();
        try {
            
            $check_product = Product::where(['name' => $request->name])->first();
            if($check_product) {
                $error['errors']['name'] = 'This product is already exist';
                return response()->json($error, 422);
            }

            $product = $this->storeProduct($request);
            $this->storeProductMeta($request, $product);
            if($request->hasFile('images')){
                $files = $request->file('images');
                for($i=0; $i<count($files); $i++){
                    $img = new Media();
                    $name = rand().'.'.$files[$i]->getClientOriginalExtension();
                    $files[$i]->move('uploads/products/',$name);
                    $img->image = $name;
                    $img->linkable_id = $product->id;
                    $img->linkable_type = 'product';
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

            $sku_data = $request->only(['sku', 'minimum_quantity','discount', 'price', 'landing_cost', 'selling_margin', 'retailer_discount', 'retailer_price', 'retailer_margin' ,'wholesale_price', 'wholesale_discount', 'wholesale_margin', 'mrp', 'purchase_price']);
            
            $sku_data['product_id'] = $product->id;
            $sku_data['quamtity'] =$request->quantity;
            $sku = ProductSku::create($sku_data);
            $tax =  ($sku->price*$product->purchase_tax)/100;
            $inventory = ProductInventory::create(['store_id' => Auth::user()->getUserStoreId(), 
            'quantity' => $request->quantity,
            'product_id' => $product->id, 
            'left_quantity' => $request->quantity,
            'sku_id' => $sku->id,
            'unit_price' =>  $sku->price,  
            'mrp' => $sku->mrp, 
            'purchase_tax' => $product->purchase_tax, 
            'unit_tax' =>$tax, 

        ]);

            
            DB::commit();
            Session::flash('success', 'Product is added successfully');
            return response(['status' => 'success' , 'url' => route('admin.product.index')]);

        }
        catch(Exception $exception) {
            DB::rollback();
            $error['errors']['name'] =$exception->getMessage();
            return response()->json($error, 422);
        }

    }

    private function storeProduct($request, $id = null) {
        $data = $request->only(['unit_type_id', 'short_description', 'net_weight', 'name','product_type', 'status', 'expiry_months', 'display_name', 'hsn_code', 'purchase_tax', 'sale_tax', 'is_purchase_tax', 'is_sale_tax']);
        $data['description'] = $request->product_description;
        if(isset($request->is_new) && !empty($request->is_new)) {
            $data['is_new'] =true;
        }
        else {
            $data['is_new'] =false;

        }
        if(isset($request->is_featured) && !empty($request->is_featured)) {
            $data['is_featured'] =true;
        }
        else {
            $data['is_featured'] =false;

        }
        if(isset($request->is_purchase_tax) && !empty($request->is_purchase_tax)) {
            $data['is_purchase_tax'] =true;
        }
        else {
            $data['is_purchase_tax'] =false;

        }
        if(isset($request->is_sale_tax) && !empty($request->is_sale_tax)) {
            $data['is_sale_tax'] =true;
        }
        else {
            $data['is_sale_tax'] =false;

        }

        if(isset($request->is_hot_product) && !empty($request->is_hot_product)) {
            $data['is_hot_product'] =true;
        }
        else {
            $data['is_hot_product'] =false;

        }

        if(isset($request->is_best_seller_offers) && !empty($request->is_best_seller_offers)) {
            $data['is_best_seller_offers'] =true;
        }
        else {
            $data['is_best_seller_offers'] =false;

        }


        if(isset($request->is_popular) && !empty($request->is_popular)) {
            $data['is_popular'] =true;
        }
        else {
            $data['is_popular'] =false;

        }
        
        if(isset($request->is_repair_tool_offers) && !empty($request->is_repair_tool_offers)) {
            $data['is_repair_tool_offers'] =true;
        }
        else {
            $data['is_repair_tool_offers'] =false;

        }

        if(isset($request->is_accessories_offers) && !empty($request->is_accessories_offers)) {
            $data['is_accessories_offers'] =true;
        }
        else {
            $data['is_accessories_offers'] =false;

        }
        
        if(isset($request->is_spare_part_offers) && !empty($request->is_spare_part_offers)) {
            $data['is_spare_part_offers'] =true;
        }
        else {
            $data['is_spare_part_offers'] =false;

        }

        if(isset($request->is_spare_part_offers) && !empty($request->is_spare_part_offers)) {
            $data['is_spare_part_offers'] =true;
        }
        else {
            $data['is_spare_part_offers'] =false;

        }
        if(isset($request->is_top_offers) && !empty($request->is_top_offers)) {
            $data['is_top_offers'] =true;
        }
        else {
            $data['is_top_offers'] =false;

        }

        if(isset($request->cod_available) && !empty($request->cod_available)) {
            $data['cod_available'] =1;
        }
        else {
            $data['cod_available'] =0;

        }
        if(isset($request->online_payment_available) && !empty($request->online_payment_available)) {
            $data['online_payment_available'] =1;
        }
        else {
            $data['online_payment_available'] =0;

        }

        
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $data['subcategory_id'] = $request->subcategory;
        $data['slug'] = Str::slug($request->name);
        if($id == null) {

            $data['created_by'] = Auth::user()->getUserStoreId();
            $product = Product::create($data);
        }
        else {
            $product = Product::find($id);
            $product->update($data);
        }
        $product->productCategories()->delete();

        if(isset($request->ecom_category)) {
            foreach($request->ecom_category as $ecom_category) {
                ProductCategory::create(['product_id' => $product->id, 'category_id' => $ecom_category]);
            }
        }
        return $product;
    }

    private function storeProductMeta($request, $product) {
        $meta_details = json_encode(['meta_title' => $request->meta_title, 'meta_keywords' => $request->meta_keywords, 'meta_description' => $request->meta_description]);
        $meta = ProductMeta::where(['linkable_type' => 'product', 'linkable_id' => $product->id, 'key' => 'meta',])->first();
        if($meta) {
            $meta->update(['content' => $meta_details]);
        }
        else {

            $meta = ProductMeta::create(['linkable_type' => 'product', 'linkable_id' => $product->id, 'key' => 'meta', 'content' => $meta_details]);
        }

    }

    function createVariantProduct($request) {
        $validations = [
            'name' => 'required|max:255|unique:products,name',
            'display_name' => 'required|max:255',
            'category' => 'required',
            'brand' => 'required',
            'variant_attributes' => 'required',
        ];
        $request->validate($validations );

        DB::beginTransaction();
        try {
            
            $check_product = Product::where(['name' => $request->name])->first();
            if($check_product) {
                $error['errors']['name'] = 'This product is already exist';
                return response()->json($error, 422);
            }

            $product = $this->storeProduct($request);
            $this->storeProductMeta($request, $product);
            if($request->hasFile('images')){
                $files = $request->file('images');
                for($i=0; $i<count($files); $i++){
                    $img = new Media();
                    $name = rand().'.'.$files[$i]->getClientOriginalExtension();
                    $files[$i]->move('uploads/products/',$name);
                    $img->image = $name;
                    $img->linkable_id = $product->id;
                    $img->linkable_type = 'product';
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

            foreach($request->variant_attributes ?? [] as $key => $variant_attribute) {
                $attribute = VariantAttribute::where('lable', $request['variant_attributes'][$key])->where('type', $request['option_type'][$key])->first();
                if(!$attribute) {
                    $attribute = VariantAttribute::create(['lable' => $request['variant_attributes'][$key], 'type' => $request['option_type'][$key]]);
                }
                $variant_attribute_data = new ProductVariantAttribute();
                $variant_attribute_data->product_id = $product->id;
                $variant_attribute_data->attribute_id = $attribute->id;
                $variant_attribute_data->attribute_options = json_encode(explode(',',$request['option_value'][$key]));
                $variant_attribute_data->save();

                // $variant_attribute_data = new ProductVariantAttribute();
                // $variant_attribute_data->product_id = $product->id;
                // $variant_attribute_data->attribute_id = $variant_attribute;
                // $variant_attribute_data->attribute_options = json_encode($request['option_value_'.$variant_attribute]);
                // $variant_attribute_data->save();

            }
            DB::commit();
            Session::flash('success', 'Product is added successfully. Please add Variants');
            return response(['status' => 'success' , 'url' => route('admin.product-multiple-variant',[$product->id])]);

        }
        catch(Exception $exception) {
            DB::rollback();
            $error['errors']['name'] =$exception->getMessage();
            return response()->json($error, 422);
        }

    } 

    public function updateSimpleProduct($request, $id) {
        $product = Product::find($id);
        $validations = [
            'name' => 'required|max:255|unique:products,name,'.$id,
            'display_name' => 'required|max:255',
            'category' => 'required',
            'brand' => 'required',
            'sku' => 'required|max:255|unique:product_skus,sku,'.$product->varaint->id,
            'purchase_tax' => 'required',
            'sale_tax' => 'required',
            'minimum_quantity' => 'required|numeric'
        ];

        $request->validate($validations );
        DB::beginTransaction();
        try {
           

            $product = $this->storeProduct($request, $id);
            $this->storeProductMeta($request, $product);
           

            $sku_data = $request->only(['tax_amount', 'net_weight','sku', 'minimum_quantity','discount', 'price', 'landing_cost', 'selling_margin', 'retailer_discount', 'retailer_price', 'retailer_margin' ,'wholesale_price', 'wholesale_discount', 'wholesale_margin', 'mrp', 'purchase_price']);
            if($product->varaint) {
                $sku = $product->varaint;
                $sku->update($sku_data);
            }
            else {
                $sku_data['product_id'] = $product->id;

                $sku = ProductSku::create($sku_data);
            }
           
            DB::commit();
            Session::flash('success', 'Product is added successfully');
            return response(['status' => 'success' , 'url' => route('admin.product.index')]);

        }
        catch(Exception $exception) {
            DB::rollback();
            $error['errors']['name'] =$exception->getMessage();
            return response()->json($error, 422);
        }

    }

    function updateVariantProduct($request, $id) {
        $validations = [
            'name' => 'required|max:255|unique:products,name,'.$id,
            'display_name' => 'required|max:255',
            'category' => 'required',
            'brand' => 'required',
        ];

       
        $request->validate($validations );

        DB::beginTransaction();
        try {
            
           

            $product = $this->storeProduct($request, $id);
            $this->storeProductMeta($request, $product);
            if($request->hasFile('images')){
                $files = $request->file('images');
                for($i=0; $i<count($files); $i++){
                    $img = new Media();
                    $name = rand().'.'.$files[$i]->getClientOriginalExtension();
                    $files[$i]->move('uploads/products/',$name);
                    $img->image = $name;
                    $img->linkable_id = $product->id;
                    $img->linkable_type = 'product';
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

            DB::commit();
            Session::flash('success', 'Product is added successfully. Please add Variants');
            return response(['status' => 'success' , 'url' => route('admin.product-multiple-variant',[$product->id])]);

        }
        catch(Exception $exception) {
            DB::rollback();
            $error['errors']['name'] =$exception->getMessage();
            return response()->json($error, 422);
        }

    } 

}