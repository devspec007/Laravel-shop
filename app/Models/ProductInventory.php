<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ProductInventory extends Model
{
    use HasFactory;
    protected $fillable = ['store_id', 'product_purchase_id', 'product_id', 'sku_id', 'quantity', 'unit_price', 'total_price', 'left_quantity', 'sale_price', 'purchase_ids', 'mrp', 'purchase_tax', 'margin', 'unit_tax'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'sku_id', 'id');
    }

    public function store()
    {
        return $this->belongsTo(User::class, 'store_id', 'id');
    }

    public static function getInventories($pagination = false, $request = null) {
        $inventories = ProductInventory::with('product')
        ->where('store_id',Auth::user()->getUserStoreId());
        // if($product_id != null) {
        //     $inventories->where('product_id', $product_id);
        // }
        if($request->search) {
            $inventories->wherehas('product', function($query) use($request){
                $query->where('name', '%'.$request->search.'%');
            });
        }
        if($request->category) {
            $inventories->wherehas('product.category', function($query) use($request){
                $query->where('id', $request->category);
            });
        }
        if($request->subcategory) {
            $inventories->wherehas('product.subcategory', function($query) use($request){
                $query->where('id', $request->subcategory);
            });
        }
        if($request->brand) {
            $inventories->wherehas('product.brand', function($query) use($request){
                $query->where('id', $request->brand);
            });
        }
        // if($request->store) {
        //     $inventories->where('store_id', $request->store);
        // }
        if($pagination == true) {

            $inventories = $inventories->paginate(10);
        }
        else {
            $inventories = $inventories->get();

        }
        return $inventories;
    }

}
