<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOrderItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id','product_id','product_name','quantity','price','total_price'
    ];

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
