<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSkuOption extends Model
{
    use HasFactory;
    public function attribute()
    {
        return $this->belongsTo(VariantAttribute::class, 'attribute_id', 'id');
    }
}
