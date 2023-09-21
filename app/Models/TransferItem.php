<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferItem extends Model
{
    use HasFactory;
    protected $fillable = ['transfer_id', 'product_id', 'sku_id', 'quantity', 'unit_price', 'total_price', 'inventory_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'sku_id', 'id');
    }

}
