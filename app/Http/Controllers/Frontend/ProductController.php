<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\ProductSku;
use App\Models\ProductSkuOption;
use Illuminate\Http\Request;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // function __construct()
    // {
    //     $this->middleware('permission:product-list|product-add|product-edit|product-delete', ['only' => ['index','store']]);
    //     $this->middleware('permission:product-add', ['only' => ['create','store']]);
    //     $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }


    public function getShopProducts(Request $request)
    {
        $category_ids = Category::whereIn('slug', $request->categories)->get()->pluck('id');
        $products = ProductSku::whereNotNull('price')
        ->whereHas('product', function($query) use($request){

            $query->where('status', 'active');
            if($request->categories && count($request->categories) > 0) {

                if(strtolower($request->categories[0]) == 'accessories') {
                    $query->where('is_accessories_offers', 1);
                }
                elseif(strtolower($request->categories[0]) == 'spare-parts') {
                    $query->where('is_spare_part_offers', 1);
                }
                elseif(strtolower($request->categories[0]) == 'reparing-tools') {
                    $query->where('is_repair_tool_offers', 1);
                }
            }
        })
        ->orderBy('price')->whereHas('inventories');
        if(isset($request->start_price) && !empty($request->start_price) && isset($request->end_price) && !empty($request->end_price)) {
            $products->where('price', '>=', $request->start_price)->where('price', '<=', $request->end_price);
        }
        if($request->categories && count($request->categories) > 0 ) {
            if( count($request->categories) == 1 && ( in_array(strtolower($request->categories[0]), ['accessories', 'spare-parts', 'reparing-tools']))) {

            }
            else {
                
                if(strtolower($request->categories[0]) != 'shop') {
    
                   
                    $products->whereHas('product.productCategories',function($query) use($request, $category_ids) {
                        $query->whereIn('product_categories.category_id', $category_ids);
                    });
    
                    
                }
            }
        }

        if($request->brands) {
            $products->where(function($query) use($request) {
                $query->whereHas('product', function($sub_query) use($request) {
                    // $sub_query->whereIn('brand_id', $request->brands);
                    $sub_query->whereIn('brand_id', $request->brands);
                    $sub_query->orwhereIn('sub_brand_id', $request->brands);
                });
            
           

            });
        }

        if(isset($request->filters)) {
            $products->whereHas('productAttributes', function($query) use($request){
                        foreach($request->filters as $index => $filter) {
                            if(isset($request['filter'.$filter]) && !empty($request['filter'.$filter])) {
                                // $query->where('attributes')
                                if($index == 0) {

                                    $query->whereIn('attribute_value', $request['filter'.$filter]);
                                }
                                else {
                                    $query->orwhereIn('attribute_value', $request['filter'.$filter]);

                                }
                            }
                        }
                    });
        }

        if(Auth::check() && strtolower(Auth::user()->type) == 'distributor') {
            $products->select('product_skus.id', 'product_skus.product_id', 'product_skus.wholesale_price as price', 'product_skus.wholesale_discount as discount');
        }
        else {
            $products->select('product_skus.id', 'product_skus.product_id', 'product_skus.price as price', 'product_skus.discount as discount');

        }


        $products = $products->with('product','product.subcategory', 'product.brand', 'product.category', 'product.primaryImage', 'productAttributes')
        ->groupBy('product_id')->paginate(100);
        return response(['products' => $products, 'category_ids' => $category_ids]);

        
    }

    public function quickView($product_id)
    {
        $product = Product::find($product_id);
        $data = view('frontend.component.product_quick_view', compact('product'))->render();
        return response(['data' => $data]);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $variants = $product->availableVaraints;
        $options = ProductSkuOption::with('attribute')->whereIn('sku_id', array_column(($product->availableVaraints)->toArray(), 'id'))->groupBy('attribute_id')->groupBy('attribute_value')->orderBy('attribute_id')->get();
        
        $varaint_options = [];
        foreach($options as $option) {
            if(isset($varaint_options[$option->attribute->id])) {
                array_push($varaint_options[$option->attribute->id], ['option' => $option->attribute_value, 'lable' => $option->attribute->lable]);
            }
            else {
                $varaint_options[$option->attribute->id] = [];
                array_push($varaint_options[$option->attribute->id], ['option' => $option->attribute_value, 'lable' => $option->attribute->lable]);

            }
        }

        $activeVariant_options = [];
        foreach($product->activeVariant->productAttributes ?? [] as $option) {
            $activeVariant_options[$option->attribute_id] = $option->attribute_value;
        }

     
        // print_r(json_encode($varaint_options));
       return view('frontend.view_product', compact('product', 'varaint_options', 'activeVariant_options'));
        
    }

    public function getVariantDetails(Request $request) {
   
        $variants = ProductSku::with('productAttributes')->whereHas('product', function($query) use($request){
            $query->where('slug', $request->slug);
        });
        foreach($request->options as $option) {
            $variants->whereHas('productAttributes', function($query) use($option, $request){
                $query->where('attribute_id', $option)->where('attribute_value', $request['options'.$option]);
            });
        }
        if(Auth::check() && strtolower(Auth::user()->type) == 'distributor') {
            $variants->select('product_skus.id', 'product_skus.product_id', 'product_skus.wholesale_price as price', 'product_skus.wholesale_discount as discount')->with('productAttributes');
        }
        else {
            $variants->select('product_skus.id', 'product_skus.product_id', 'product_skus.price as price', 'product_skus.discount as discount')->with('productAttributes');


        }
        $variants = $variants->first();
        return response(['data' => $variants]);
    }

    public function searchProduct(Request $request)
    {
        $products = ProductSku::whereNotNull('price')
        ->whereHas('product', function($query) use($request){

            $query->where('status', 'active');
            $query->where('name', 'like', '%'.$request->search.'%');
        })
        ->orderBy('price')->whereHas('inventories');
        $products = $products->with('product','product.subcategory', 'product.brand', 'product.category', 'product.primaryImage', 'productAttributes')
        ->groupBy('product_id')->paginate(1);
        return response(['products' => $products, 'category_ids' => $products]);

        return response(['data' => $request->all()]);
    }

    public function addReview(Request $request)
    {
        $product = Product::where('slug', $request->product_id)->first();
        if(Auth::check()) {
            $request->validate([
                'rating' => 'required|min:1|max:5',
                'comment' => 'required'
            ]);
            $data = $request->only(['comment', 'rating']);
            $data['product_id'] = $product->id;
            $data['user_id'] = Auth::user()->id;
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
        }
        else {
            $request->validate([
                'rating' => 'required|min:1|max:5',
                'comment' => 'required',
                'name' => 'required|max:255',
                'email' => 'required|max:255|email'

            ]);
            $data = $request->only(['comment', 'rating', 'name', 'email']);
            $data['product_id'] = $product->id;


        }
        ProductReview::create($data);
        return response(['message' => 'Review successfuly posted. Please wait for admin review.']);


    }
}
