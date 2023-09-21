<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = ['sku_id', 'product_id', 'user_id', 'rating', 'name','email', 'comment'];
    public function product(){
        return $this->belongsTo(ProductReview::class, 'product_id', 'id');
    }
}
