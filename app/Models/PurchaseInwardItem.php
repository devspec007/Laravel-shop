<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseInwardItem extends Model
{
    use HasFactory;
    protected $fillable = ['inward_id', 'purchase_item_id', 'sku_id', 'quantity', 'received_quantity', 'pur_disc_1', 'pur_disc_2', 'pending_amount', 'amount'];
    public function purchaseItem() {
        return $this->belongsTo(PurchaseItem::class, 'purchase_item_id', 'id');
    }
    public function sku()
    {
       return $this->belongsTo(ProductSku::class, 'sku_id', 'id');
    }

    
    public function supplierBill(){
        return $this->hasOne(ShippingBillItem::class, 'inward_item_id', 'id');
    }
}
