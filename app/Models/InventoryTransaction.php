<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['linkable_type', 'linkable_id', 'total_amount', 'paid_amount', 'due_amount', 'created_by', 'transaction_date', 'payment_type', 'note', 'additional_data'];
}
