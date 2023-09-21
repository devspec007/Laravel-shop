<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = ['to_store', 'from_store', 'note', 'transfer_store', 'total_amount', 'total_amount_paid', 'due_amount', 'total_quantity', 'payment_type', 'transfer_date', 'transfer_id'];

    public function fromStore()
    {
        return $this->belongsTo(User::class, 'from_store', 'id');
    }
    public function toStore()
    {
        return $this->belongsTo(User::class, 'to_store', 'id');
    }


    public function transferItems()
    {
        return $this->hasMany(TransferItem::class, 'transfer_id', 'id');
    }
}
