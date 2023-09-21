<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['is_popular','name', 'code', 'description', 'image', 'status', 'p_id', 'type', 'sequance', 'slug', 'created_by', 'department_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'p_id', 'id');
    }

    public function childCategory()
    {
        return $this->hasMany(Category::class, 'p_id', 'id');
    }

    public function activeChildCategory()
    {
        return $this->hasMany(Category::class, 'p_id', 'id')->where('status', 'active');
    }

    public static function getParentCategories()
    {
        return Category::whereNull('p_id')->where('status', 'active')->get();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public static function popularCategories() {
        return Category::where(['is_popular' => 1, 'status' => 'active'])->get();

    }
}
