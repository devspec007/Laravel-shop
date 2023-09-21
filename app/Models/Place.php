<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'p_id'];
    public function parent()
    {
       return $this->belongsTo(Place::class, 'p_id', 'id');
    }

    public function child()
    {
        return $this->hasMany(Place::class, 'p_id', 'id');
    }

    public static function getStates(){
        return Place::where('type', 'state')->get();
    }
}
