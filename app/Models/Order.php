<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable =   ['store_id', 'order_date', 'quantity', 'payment_type', 'subtotal', 'discount_type', 'discount_amount', 'total_amount', 'payable_amount', 'order_status', 'payment_status', 'order_type', 'customer_id', 'customer_name', 'customer_mobile', 'due_amount', 'paid_amount', 'gst_percentage', 'gst_amount', 'billing_address', 'shipping_address', 'delivery_type', 'approved_status', 'reject_reason', 'is_delivered', 'order_transfer_status', 'order_status_type', 'order_cancel_reason', 'reorder_status', 'commission', 'cancel_reason', 'return_tags', 'discount_reason', 'other_informations', 'discount_request', 'collection_type'];

    public function store()
    {
        return $this->belongsTo(User::class, 'store_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function lastFollowup() {
        return $this->hasone(CustomerFollowup::class, 'order_id', 'id')->orderBy('id', 'desc');
    }
}
