<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    use HasFactory;
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'item_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'linkable_id', 'id');
    }

    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class, 'item_id', 'id');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'linkable_id', 'id');
    }
}
