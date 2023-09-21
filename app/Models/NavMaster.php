<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;
class NavMaster extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icons', 'permissions', 'path', 'parent_id', 'orders'];
}
