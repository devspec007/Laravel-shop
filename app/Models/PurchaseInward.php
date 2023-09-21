<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class PurchaseInward extends Model
{
    use HasFactory;
    protected $fillable = ['created_by','inward_no', 'inward_date', 'note', 'purchase_id', 'supplier_id', 'store_id' ,'received_by', 'total_amount', 'receiver_id', 'pending_amount', 'amount'];


    public static function getInwardList($pagination = true, $request = null) {
        $list = PurchaseInward::orderBy('id', 'desc')->where('store_id', Auth::user()->getUserStoreId());
       
        if($pagination == true) {

            $list = $list->paginate(10);
        }
        else {
            $list = $list->get();
        }
        return $list;
    }

    public function supplier() {
        return $this->belongsTo(User::class, 'supplier_id', 'id');
    }
    public function receiver() {
        return $this->belongsTo(User::class, 'received_by', 'id');
    }
    public function purchase() {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
    }
    public function inwardItems() {
        return $this->hasMany(PurchaseInwardItem::class, 'inward_id', 'id');
    }

    public static function findById($id) {
        return PurchaseInward::where('id', $id)->where('store_id', Auth::user()->getUserStoreId())->first();

    }
    
   

    public function pendingPurchaseItems()
    {
        return $this->hasMany(PurchaseInwardItem::class, 'inward_id', 'id')
        // ->whereNotHas('supplierBill')
        ->where('pending_amount' , '>', 0);
        ;
    }

    public function supplierBill(){
        return $this->hasOne(ShippingBill::class, 'inward_id', 'id');
    }
    public function store()
    {
        return $this->belongsTo(User::class, 'store_id', 'id');
    }
}
