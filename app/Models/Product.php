<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['short_description','net_weight', 'unit_type_id', 'display_name', 'name', 'sku', 'brand_id','sub_brand_id', 'category_id', 'subcategory_id', 'slug', 'description', 'status', 'created_by', 'product_type', 'expiry_months', 'display_name', 'hsn_code', 'purchase_tax', 'sale_tax', 'is_purchase_tax', 'is_sale_tax', 'is_hot_product', 'is_best_seller_offers', 'is_repair_tool_offers', 'is_accessories_offers', 'is_spare_part_offers', 'is_top_offers', 'cod_available', 'online_payment_available', 'is_new', 'is_featured', 'is_popular'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function primaryImage()
    {
        return $this->hasOne(Media::class, 'linkable_id', 'id')->where(['linkable_type'=> 'product', 'is_primary' => 1]);
    }

    public function productImages()
    {
        return $this->hasMany(Media::class, 'linkable_id', 'id')->where(['linkable_type'=> 'product']);
    }

    public function variantOptions()
    {
       return $this->hasMany(ProductVariantAttribute::class, 'product_id', 'id');
    }

    public function varaints()
    {
        return $this->hasMany(ProductSku::class, 'product_id', 'id');
    }

    public function varaint()
    {
        return $this->hasOne(ProductSku::class, 'product_id', 'id');
    }

    
    public function activeVariant()
    {
        return $this->hasOne(ProductSku::class, 'product_id', 'id')->orderBy('price')->whereHas('inventories');
    }
    public function availableVaraints()
    {
        return $this->hasMany(ProductSku::class, 'product_id', 'id')->whereHas('inventories')->orderBy('price', 'asc');
    }

    public function inventories()
    {
        return $this->hasMany(ProductInventory::class , 'product_id', 'id')->where('left_quantity', '>', 0);
    }

    public function currentInventories()
    {
        return $this->hasMany(ProductInventory::class , 'product_id', 'id')->where('left_quantity', '>', 0)->where('store_id', Auth::id());
    }

    public function productFullName()
    {
        return $this->name;
       $name = $this->name;
       if( $this->category ) {
        $name .= ' '.$this->category->name;
       }
       if( $this->subcategory ) {
        $name .= ' '.$this->subcategory->name;
       }
       if( $this->brand ) {
        $name .= ' '.$this->brand->name;
       }
       return $name;
    }

    public function attributes()
    {
        return $this->belongsToMany(VariantAttribute::class,ProductVariantAttribute::class,'product_id','variant_id');
        return $this->hasMany(ProductVariantAttribute::class, 'product_id', 'id');
    }


    
    public static function activeNewProducts()
    {
        return Product::where(['is_new' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }

    public static function activeHotProducts()
    {
        return Product::where(['is_hot_product' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }

    public static function activeBestOfferProducts()
    {
        return Product::where(['is_best_offers' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }

    public static function activeRepairToolOfferProducts()
    {
        return Product::where(['is_repair_tool_offers' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }

    public static function activeAccessoryOfferProducts()
    {
        return Product::where(['is_accessories_offers' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }
    public static function activeSpairPartOfferProducts()
    {
        return Product::where(['is_spare_part_offers' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->wherehas('activeVariant')->get();
    }

    public static function activeTopOfferProducts()
    {
        return Product::where(['is_top_offers' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }
    public static function activeBestSellerOfferProducts()
    {
        return Product::where(['is_best_seller_offers' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }
    public static function activeFeaturdProducts()
    {
        return Product::where(['is_featured' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }
    public static function activePopularProducts()
    {
        return Product::where(['is_popular' => 1, 'status' => 'active'])->with('subcategory', 'brand', 'category', 'varaints', 'varaints.productAttributes', 'primaryImage')->orderBy('created_at')->get();
    }

    public function productCategories() {
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }
    

    public function activeSKU()
    {
        if(Auth::check() && strtolower(Auth::user()->type) == 'distributor') {
            return $this->hasOne(ProductSku::class, 'product_id', 'id')->orderBy('wholesale_price')->whereHas('inventories')->select('product_skus.id', 'product_skus.product_id', 'product_skus.wholesale_price as price', 'product_skus.wholesale_discount as discount');
        }
        else {
            return $this->hasOne(ProductSku::class, 'product_id', 'id')->orderBy('wholesale_price')->whereHas('inventories');

        }
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id')->orderBy('id', 'desc');
    }

    public function getAvgRating()
    {
        $avg_rating = 0;
        if(count($this->reviews) > 0) {

            $avg_rating = array_sum(array_column(($this->reviews)->toArray(), 'rating'))/count($this->reviews);
        }
        return $avg_rating;
    }
    
}
