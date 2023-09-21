<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ProductSku extends Model
{
    use HasFactory;
    // protected $fillable = ['sku', 'tax', 'discount', 'price', 'minimum_quantity', 'quantity', 'product_id', 'status', 'regular_price', 'discount_start_date', 'discount_type', 'discount_end_date', 'wholesale_price', 'wholesale_discount', 'wholesale_regular_price', 'wholesale_discount_start_date', 'wholesale_discount_end_date', 'wholesale_discount_type', 'enable_for_customer', 'enable_for_wholesale', 'mrp', 'purchase_price', 'left_quantity'];
    protected $fillable = ['tax_amount', 'product_id', 'status', 'regular_price', 'sku','minimum_quantity','mrp','purchase_price','discount','price','selling_margin','retailer_discount','retailer_price','retailer_margin','wholesale_discount','wholesale_price','wholesale_margin','landing_cost' ,'quantity'];
    public function productAttributes()
    {
        return $this->hasMany(ProductSkuOption::class, 'sku_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(ProductInventory::class , 'sku_id', 'id')->where('left_quantity', '>', 0);
    }


    public function storeInventories()
    {
        return $this->hasMany(ProductInventory::class , 'sku_id', 'id')->where('left_quantity', '>', 0);
    }


    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function media()
    {
        return $this->hasMany(Media::class , 'linkable_id', 'id')->where('linkable_type', 'product-variant')->orderBy('sequance', 'asc');
    }

    public function stock()
    {
        return $this->hasOne(ProductInventory::class , 'sku_id', 'id')->where('left_quantity', '>', 0)->where('store_id',Auth::user()->getUserStoreId());
    }

}
