<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingBillItem extends Model
{
    use HasFactory;
    protected $fillable = ['shipping_bill_id', 'inward_item_id', 'purchase_item_id', 'sku_id', 'quantity', 'amount', 'pending_amount'];
   
    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class, 'purchase_item_id', 'id');
    }
}
