<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class ShippingBill extends Model
{
    use HasFactory;
    protected $fillable = ['created_by','supplier_id', 'payment_status', 'payment_type', 'paid_amount', 'pending_amount', 'store_id', 'note', 'total_amount', 'purchase_id', 'inward_id', 'supply_date', 'shipping_date', 'due_date', 'bill_no'];
 
    public static function getList($pagination = true, $request = null) {
        $list = ShippingBill::orderBy('id', 'desc')->where('store_id', Auth::user()->getUserStoreId());
       
        if($pagination == true) {

            $list = $list->paginate(10);
        }
        else {
            $list = $list->get();
        }
        return $list;
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id', 'id');
    }

    public function inward()
    {
        return $this->belongsTo(PurchaseInward::class, 'inward_id', 'id');
    }
    public function supplyItems()
    {
        return $this->hasMany(ShippingBillItem::class, 'shipping_bill_id', 'id');
    }

    public function inventoryTransactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'linkable_id', 'id')->where('linkable_type', 'supplier-bill')->orderBy('id', 'desc');
    }

}

