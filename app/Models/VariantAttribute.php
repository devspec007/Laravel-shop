<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;
    protected $table = 'attributes';
    protected $fillable = ['lable', 'options', 'status', 'created_by', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function attribute()
    {
        return $this->belongsTo(VariantAttribute::class, 'attribute_id', 'id');
    }
}
