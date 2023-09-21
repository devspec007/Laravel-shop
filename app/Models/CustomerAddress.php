<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'phone_no', 'address', 'city_id', 'area', 'state_id', 'status', 'pincode'];
    public function state()
    {
        return $this->belongsTo(Place::class, 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(Place::class, 'city_id', 'id');
    }
}
