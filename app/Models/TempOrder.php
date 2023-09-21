<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','phone','notes','order_value'
    ];

    public function items(){
        return $this->hasMany(TempOrderItem::class,'order_id','id');
    }
}
