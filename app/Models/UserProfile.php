<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'image', 'address', 'description', 'state_id', 'city_id', 'commission'];

    public function state()
    {
        return $this->belongsTo(Place::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Place::class, 'city_id', 'id');
    }
}
