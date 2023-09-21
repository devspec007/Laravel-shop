<?
namespace App\Traits;

use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductMeta;
use App\Models\ProductSku;
use App\Models\ProductVariantAttribute;
use Attribute;
use Auth;
use Exception;
use Illuminate\Support\Str;
use Sesssion;
trait ProductTrait {
    public function createSimpleProduct($request) {
        $validations = [
            'name' => 'required|max:255|unique:products,name',
            'display_name' => 'required|max:255',
            'category' => 'required',
            'brand' => 'required',
            'sku' => 'required|max:255|unique:product_skus,sku',
        ];
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
            $sku = ProductSku::create($sku_data);
            $inventory = ProductInventory::create(['store_id' => Auth::user()->getUserStoreId(), 
            'quantity' => $request->quantity,
            'product_id' => $product->id, 
            'left_quantity' => $request->quantity,
            'sku_id' => $sku->id]);
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

    private function storeProduct($request) {
        $data = $request->only(['unit_type_id', 'name', 'description', 'product_type', 'status', 'expiry_months', 'display_name', 'hsn_code', 'purchase_tax', 'sale_tax', 'is_purchase_tax', 'is_sale_tax']);
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $data['subcategory_id'] = $request->subcategory;
        $data['slug'] = Str::slug($request->name);
        $data['created_by'] = Auth::user()->getUserStoreId();
        $product = Product::create($data);
        return $product;
    }

    private function storeProductMeta($request, $product) {
        $meta_details = json_encode(['meta_title' => $request->meta_title, 'meta_keywords' => $request->meta_keywords, 'meta_description' => $request->meta_description]);
        $meta = ProductMeta::create(['linkable_type' => 'product', 'linkable_id' => $product->id, 'key' => 'meta', 'content' => $meta_details]);

    }

    function createVariantProduct($request) {
        $validations = [
            'name' => 'required|max:255|unique:products,name',
            'display_name' => 'required|max:255',
            'category' => 'required',
            'brand' => 'required',
            'variant_attributes' => 'required'
        ];
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
                $attribute = Attribute::where('lable', $request['variant_attributes'][$key])->where('type', $request['option_type'][$key])->first();
                $variant_attribute_data = new ProductVariantAttribute();
                $variant_attribute_data->product_id = $product->id;
                $variant_attribute_data->attribute_id = $attribute->id;
                $variant_attribute_data->attribute_options = json_encode(explode(',',$request['option_value'][$key]));
                $variant_attribute_data->save();

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