<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemInventory extends Model
{
    use HasFactory;
    protected $fillable = ['order_item_id', 'inventory_id', 'quantity', 'sale_price', 'purchase_price'];


    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class, 'inventory_id', 'id');
    }
}
