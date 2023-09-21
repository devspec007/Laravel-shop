<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ProductSkuOption;
use App\Models\ProductVariantAttribute;
use App\Models\VariantAttribute;
use Attribute;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Auth;
class ProductImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        ini_set('max_execution_time', '0');

        foreach ($rows as $key => $row) {
            // print_r($row);
            // die;
            if ($key > 0) {
               
                $category = Category::where('name', $row[2])->whereNull('p_id')->first();
                if($category) {
                    $sub_category = Category::where('name', $row[3])->where('p_id' , $category->id)->first();
                    if($sub_category) {
                        $brand = Brand::where('name', $row[4])->first();
                        if($brand) {
                            $check_product = Product::where(['name' => $row[0], 
                            'category_id' => $category->id, 
                            'brand_id' => $brand->id,
                            'subcategory_id' =>$sub_category->id])->first();

                            if(!$check_product) {
                            
                                $data = ['name' => $row[0], 'description' => $row[11], 'product_type' => $row[12]];
                                $data['category_id'] = $category->id;
                                $data['brand_id'] = $brand->id;
                                $data['subcategory_id'] = $sub_category->id;
                                $data['slug'] = Str::slug($row[0]);
                                $data['created_by'] = Auth::id();
                                $product = Product::create($data);
                            }
                            if($product) {
                                
                                $sku_data = ['sku' => $row[1], 'price' => $row[5]];
                                $sku_data['product_id'] = $product->id;
                                $sku_data['regular_price'] = $row[5];
                                $sku = ProductSku::where(['product_id' => $product->id, 'sku' => $row[1]])->first();
                                if(!$sku) {

                                    $sku = ProductSku::create($sku_data);
                                }
                                else {
                                    $sku->update($sku_data);
                                }
                                $variant_attributes = [];
                                if(!empty($row[8])) {
                                    $product->product_type = 'variant';
                                    $product->save();
                                    $variant_attributes = explode(';', $row[8]);

                                    for($i = 0; $i< count($variant_attributes); $i++) {
                                        $attribute_data = explode(':', $variant_attributes[$i]);
                                        $check_attribute = VariantAttribute::where('lable', $attribute_data[0])->first();
                                        if(!empty($check_attribute)) {
                                            if(isset($attribute_data[1]) && !empty($attribute_data[1])) {
                                                
                                                $product_option = ProductSkuOption::where(['sku_id' => $sku->id, 'attribute_id' => $check_attribute->id])->first();
                                                if(!$product_option) {

                                                    $product_option = new ProductSkuOption();
                                                    $product_option->sku_id = $sku->id;
                                                    $product_option->attribute_id = $check_attribute->id;
                                                    $product_option->attribute_value = $attribute_data[1];
                                                    $product_option->attribute_type = 'filter';
                                                    $product_option->save();
                                                }
                                                else {
                                                    $product_option->attribute_value = $attribute_data[1];
                                                    $product_option->save();
                                                }
                                
                                            }
                                            $check_product_attribute = ProductVariantAttribute::where(['product_id'=>$product->id, 'variant_id' => $check_attribute->id])->first();
                                            if(!$check_product_attribute) {

                                                $variant_attribute_data = new ProductVariantAttribute();
                                                $variant_attribute_data->product_id = $product->id;
                                                $variant_attribute_data->variant_id = $check_attribute->id;
                                                $variant_attribute_data->save();
                                            }
                                        }

                                        
                            

                                        
                            
                                    }


                                    
                                }
                    
                            }
                            
                        }
                    }
                }
                
            }
        }
    }
}
