<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;
    protected $fillable = ['purchase_id', 'product_id', 'sku_id', 'quantity', 'unit_price', 'total_price', 'sale_price', 'received_quantity', 'pending_quantity', 'mrp', 'purchase_tax', 'margin', 'unit_tax'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
        
    }

    public function sku()
    {
       return $this->belongsTo(ProductSku::class, 'sku_id', 'id');
    }
}
