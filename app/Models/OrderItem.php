<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'amount', 'description', 'quantity', 'sku_code', 'sku_id', 'type', 'created_by', 'item_options', 'updated_by', 'inventoty_id', 'purchase_price', 'left_quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'sku_id', 'id');
    }
    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class, 'inventory_id', 'id');
    }

    public function inventories()
    {
        return $this->hasMany(OrderItemInventory::class, 'order_item_id', 'id');
    }
}
