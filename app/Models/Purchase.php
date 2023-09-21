<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['created_by','store_id', 'supplier_id', 'purchase_date', 'refrence_number', 'total_amount', 'total_amount_paid', 'due_amount', 'note', 'total_quantity', 'payment_type', 'store_id', 'payment_status', 'supplier_date'];

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id', 'id');
    }

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
    }

    public function pendingPurchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id')->where('pending_quantity' , '>', 0);
    }

    public function store()
    {
        return $this->belongsTo(User::class, 'store_id', 'id');
    }

    public function inwards()
    {
        return $this->hasMany(PurchaseInward::class, 'purchase_id', 'id');
    }

}
