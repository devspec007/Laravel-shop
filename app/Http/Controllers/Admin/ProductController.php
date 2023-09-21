<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductMeta;
use App\Models\ProductSku;
use App\Models\ProductSkuOption;
use App\Models\ProductVariantAttribute;
use App\Models\User;
use App\Models\VariantAttribute;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UnitType;
use App\Traits\ProductTrait;
class ProductController extends Controller
{
    use ProductTrait;
    function __construct()
    {
        // $this->middleware('permission:product-list|product-add|product-edit|product-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:product-add', ['only' => ['create','store']]);
        // $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('id', 'desc');
        if(isset($request->search) && !empty($request->search)) {
            $products->where('name', 'like', '%'.$request->search.'%');
        }
        if(isset($request->category) && !empty($request->category)) {
            $products->where('category_id', $request->category);
        }
        if(isset($request->subcategory) && !empty($request->subcategory)) {
            $products->where('subcategory_id', $request->subcategory);
        }
        if(isset($request->brand) && !empty($request->brand)) {
            $products->where('brand_id', $request->brand);
        }
        if(isset($request->status) && !empty($request->status)) {
            $products->where('status', $request->status);
        }
        $products = $products->paginate(10);
        $categories = Category::get();
        $brands = Brand::get();
        $subcategories = [];
        if(isset($request->category) && !empty($request->category)) {
            $subcategories = Category::where('p_id', $request->category)->get();
        }
        return view('admin.product.productlist', compact('products', 'request', 'categories', 'brands', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('p_id')->get();
        $brands = Brand::get();
        $variant_attributes = VariantAttribute::get();
        $stores = User::orderBy('id', 'desc')->whereIn('type', ['store', 'admin'])->get();
        $units = UnitType::get();
        return view('admin.product.addproduct', compact('categories', 'brands', 'variant_attributes', 'stores', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->product_type == 'simple') {
            return $this->createSimpleProduct($request);
        }
        else {
            return $this->createVariantProduct($request);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.product-details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $product = Product::find($id);
        $categories = Category::whereNull('p_id')->get();
        $brands = Brand::get();
        $variant_attributes = VariantAttribute::get();
        $product_variant_attribute_ids = [];
        if($product->variantOptions) {
            $product_variant_attribute_ids = array_column(($product->variantOptions)->toArray(), 'variant_id');
        }
        $meta_details = [];
        $meta = ProductMeta::where(['linkable_type' => 'product', 'linkable_id' => $product->id, 'key' => 'meta'])->first();
        if($meta && !empty($meta->content)) {
            $meta_details = json_decode($meta->content, true);
        }
        $units = UnitType::get();
        $product_categories = [];
        if(count($product->productCategories) > 0) {
            $product_categories = array_column(($product->productCategories)->toArray(), 'category_id');
        }
        return view('admin.product.editproduct', compact('units', 'product', 'categories', 'brands', 'variant_attributes', 'product_variant_attribute_ids', 'meta_details', 'product_categories'));

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
        $product = Product::find($id);
        if($product->product_type == 'simple') {
            return $this->updateSimpleProduct($request, $id);
        }
        else {
            return $this->updateVariantProduct($request, $id);

        }

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

    public function multipleProductIndex()
    {
        $categories = Category::whereNull('p_id')->get();
        $brands = Brand::get();
        $variant_attributes = VariantAttribute::get();

        return view('admin.product.multiple-products', compact('categories', 'brands', 'variant_attributes'));
    }


    public function renderMultipleProduct()
    {
        $categories = Category::whereNull('p_id')->get();
        $brands = Brand::get();
        $variant_attributes = VariantAttribute::get();
        $data = view('admin.product.multiple-product-form', compact('categories', 'brands', 'variant_attributes'))->render();
        return response(['data' => $data]);
    }

    public function multipleProductStore(Request $request)
    {
        DB::beginTransaction();
        // $request->validate([
        //     'name' => 'required|max:255',
        //     'category' => 'required',
        //     'subcategory' => 'required',
        //     'brand' => 'required',
        //     // 'unit' => 'required',
        //     'sku' => 'required|max:255|unique:product_skus,sku',
        //     // 'minimum_quantity' => 'required|numeric',
        //     // 'quantity' => 'required|numeric',
        //     // 'description' => 'required',
        //     'tax' => 'nullable|numeric',
        //     'discount' => 'nullable|numeric',
        //     'price' => 'required|numeric',
        //     // 'images' => 'required|mimes:jpeg,png,jpg,gif,webp',

        // ]);

        $total_rows = count($request->name);
        $input = $request->all();
      
        for($row = 0; $row < $total_rows; $row++) {
            // return response(['data' => $input['name'][$row]], 422);
            $check_product = Product::where(['name' => $input['name'][$row], 
                                            'category_id' => $input['category'][$row], 
                                            'brand_id' => $input['brand'][$row],
                                            'subcategory_id' => $input['subcategory'][$row]])->first();
            if($check_product) {
                $error['errors']['name'] = 'This product is already exist';
                return response()->json($error, 422);
            }
           
            $data = ['name' => $input['name'][$row], 'description' => $input['description'][$row], 'product_type' => $input['product_type'][$row], 'status' => $input['status'][$row], 'expiry_months' => $input['expiry_months'][$row]];
            $data['category_id'] = $input['category'][$row];
            $data['brand_id'] = $input['brand'][$row];
            $data['subcategory_id'] = $input['subcategory'][$row];
            $data['slug'] = Str::slug($input['name'][$row]);
            $data['created_by'] = Auth::id();
            $product = Product::create($data);

            if($product) {
                $sku_data = ['sku' => $input['sku'][$row], 'price' => $input['price'][$row]];
                $sku_data['product_id'] = $product->id;
                $sku_data['regular_price'] = $input['price'][$row];
                ProductSku::create($sku_data);
    
            }
        }

        

        DB::commit();
        Session::flash('success', 'Product is added successfully');
        return response(['status' => 'success' , 'url' => route('admin.product.index')]);
    }


    public function importIndex()
    {
       return view('admin.product.importproduct');
    }


    public function importProduct(Request $request)
    {
        Excel::import(new ProductImport, $request->file('file')->store('temp'));
        Session::flash('success', 'Product imported successfully');
        return back();
    }

    public function searchProduct(Request $request)
    {
       
        $products = Product::join('categories as p_category', 'p_category.id', '=', 'products.category_id')
        ->join('categories as sub_category', 'sub_category.id', '=', 'products.category_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->join('product_skus as sku', 'sku.product_id', '=', 'products.id')
        ->join('product_sku_options as option', 'option.sku_id', '=', 'sku.id')

        ->where('products.name', 'like', '%'.$request->search.'%')
        ->orwhere('sub_category.name', 'like', '%'.$request->search.'%')
        ->orwhere('p_category.name', 'like', '%'.$request->search.'%')
        ->orwhere('brands.name', 'like', '%'.$request->search.'%')
        ->orwhere('option.attribute_value', 'like', '%'.$request->search.'%')
        ->groupBy('products.id')
        ->select('sku.id as sku_id','products.*', 'p_category.name as category', 'sub_category.name as subcategory', 'brands.name as brand_name')
        ->with('varaints.productAttributes')
        // ->select('products.*', 'p_category.name as category', 'sub_category.name as subcategory', 'brands.name as brand_name')
        ->get();

        return response(['satus' => 'success', 'data' => $products]);

    }


    public function searchProductForTranser(Request $request)
    {
        // $products = Product::join('product_inventories','product_inventories.product_id', '=', 'products.id')
        // ->join('product_skus','product_inventories.sku_id', '=', 'product_skus.id')
        // ->join('categories as sub_category', 'sub_category.id', '=', 'products.category_id')
        // ->join('categories as p_category', 'p_category.id', '=', 'products.category_id')
        // ->join('brands', 'brands.id', '=', 'products.brand_id')
        // ->distinct('product_inventories.sku_id')
        // ->select('product_inventories.*', 'products.name as product_name', 'p_category.name as category', 'sub_category.name as subcategory', 'brands.name as brand_name', 'product_skus.sku as sku', 'product_skus.id as sku_id')->get();

        // ;
        // $products = $products->select('product_inventories.sku_id')->get();

        // return response(['satus' => 'success', 'data' => $products]);
        $products = ProductInventory::orderBy('id', 'desc')
        ->where('product_inventories.left_quantity', '>', 0)
        ->where('product_inventories.store_id', $request->from_store)
        ->join('product_skus','product_inventories.sku_id', '=', 'product_skus.id')

        ->join('products', 'product_inventories.product_id', '=', 'products.id')
        ->join('categories as sub_category', 'sub_category.id', '=', 'products.category_id')
        ->join('categories as p_category', 'p_category.id', '=', 'products.category_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        // ->whereNotIn('id', $request->inventory_id)
        // ->leftJoin('product_skus', 'product_skus.product_id', '=', 'products.id')
        // ->where('products.name', 'like', '%'.$request->search.'%')
        // ->orwhere('sub_category.name', 'like', '%'.$request->search.'%')
        // ->orwhere('p_category.name', 'like', '%'.$request->search.'%')
        // ->orwhere('brands.name', 'like', '%'.$request->search.'%')
        ->where(function($query) use($request) {

            $query->where('products.name', 'like', '%'.$request->search.'%')
            ->orwhere('sub_category.name', 'like', '%'.$request->search.'%')
            ->orwhere('p_category.name', 'like', '%'.$request->search.'%')
            ->orwhere('brands.name', 'like', '%'.$request->search.'%')
            ;
        })
        ;
        if(isset($request->inventory_id) && !empty($request->inventory_id)) {
            $products->whereNotIn('product_inventories.id', $request->inventory_id);
        }
        
        $products = $products->distinct('product_inventories.id')
        ->select('product_inventories.*', 'product_inventories.id as product_inventories_id', 'products.name as product_name', 'p_category.name as category', 'sub_category.name as subcategory', 'brands.name as brand_name', 'product_skus.sku as sku', 'product_skus.id as sku_id')->get();
        return response(['satus' => 'success', 'data' => $products]);


        $products = Product::join('categories as p_category', 'p_category.id', '=', 'products.category_id')
        ->join('categories as sub_category', 'sub_category.id', '=', 'products.category_id')
        ->join('brands', 'brands.id', '=', 'products.brand_id')
        ->where('products.name', 'like', '%'.$request->search.'%')
        ->orwhere('sub_category.name', 'like', '%'.$request->search.'%')
            ->orwhere('p_category.name', 'like', '%'.$request->search.'%')
            ->orwhere('brands.name', 'like', '%'.$request->search.'%');
        // ->orwhere(function($query) use($request) {

        //     $query->orwhere('sub_category.name', 'like', '%'.$request->search.'%')
        //     ->orwhere('p_category.name', 'like', '%'.$request->search.'%')
        //     ->orwhere('brands.name', 'like', '%'.$request->search.'%');
        // });
        // if(isset($request->store_id)) {

        //     $products->whereHas('inventories', function($query) use($request) {
        //         $query->where('left_quantity', '>', 0)
        //         ->where('store_id', $request->store_id);
        //     });
        // }

        $products->leftjoin('product_skus', 'product_skus.product_id', '=', 'products.id')
        ->leftjoin('product_inventories', 'product_inventories.product_id', '=', 'products.id')
        ->where('product_inventories.left_quantity', '>', 0)
        ->where('product_inventories.store_id', $request->store_id);
       
        $product = $products->select('products.name as product_name', 'p_category.name as category', 'sub_category.name as subcategory', 'brands.name as brand_name', 'products.name', 'product_skus.sku', 'product_inventories.*', 'product_skus.id as sku_id')


        // $products = $products->select('products.*', 'p_category.name as category', 'sub_category.name as subcategory', 'brands.name as brand_name')
        // ->groupBy('products.id')
        ->get();

        return response(['satus' => 'success', 'data' => $products]);

    }

    public function getVariantTemplate(Request $request) {
        $data = view('admin.product.variant_product_template', compact('request'))->render();
        return response(['data' => $data]);
    }

    public function getMultipleVariant($product_id, $type = 'add') {
        $product = Product::find($product_id);
       return view('admin.product.multiple_variant_product', compact('product', 'type'));
       
    }

    public function getMultipleVariantTemplate($product_id) {
        $product = Product::find($product_id);

        $data = view('admin.product.multiple_variant_product_template', compact('product'))->render();
        return response(['data' => $data]);
    }
  
}
