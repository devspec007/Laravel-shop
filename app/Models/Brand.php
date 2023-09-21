<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description', 'image', 'status','sequance', 'slug', 'created_by', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Brand::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(Brand::class, 'parent_id', 'id');
    }
    public static function activeBrands() {
        return Brand::where(['status' => 'active'])->get();

    }
}
