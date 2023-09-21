<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'type',
        'status',
        'created_by',
        'role_id',
        'user_type',
        'additional_data'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public static function getUserStoreId() {
        if(Auth::user()->type == 'admin' || Auth::user()->type == 'store') {
            return Auth::user()->id;
        }
        else {
            return Auth::user()->created_by;
        }
    }

    public static function getSuppliers($pagination =false, $request = null) {
        $users = User::orderBy('id', 'desc')->where('type', 'supplier')->where('created_by', User::getUserStoreId());
        if(isset($request->name) && !empty($request->name)) {
            $users->where('name', 'like', '%'.$request->name.'%');
        }
        if(isset($request->email) && !empty($request->email)) {
            $users->where('email', 'like', '%'.$request->email.'%');
        }
        if(isset($request->contact) && !empty($request->contact)) {
            $users->where('contact', 'like', '%'.$request->contact.'%');
        }
        if(isset($request->status) && !empty($request->status)) {
            $users->where('status', $request->status);
        }
        if($pagination == true) {

            $users = $users->paginate(10);
        }
        else {
            $users = $users->get();
        }
        return $users;
    }

    public static function getEmployees($pagination =false, $request = null) {
        $users = User::orderBy('id', 'desc')->where('type', 'employee')->where('created_by', User::getUserStoreId());
        if(isset($request->name) && !empty($request->name)) {
            $users->where('name', 'like', '%'.$request->name.'%');
        }
        if(isset($request->email) && !empty($request->email)) {
            $users->where('email', 'like', '%'.$request->email.'%');
        }
        if(isset($request->contact) && !empty($request->contact)) {
            $users->where('contact', 'like', '%'.$request->contact.'%');
        }
        if(isset($request->status) && !empty($request->status)) {
            $users->where('status', $request->status);
        }
        if($pagination == true) {

            $users = $users->paginate(10);
        }
        else {
            $users = $users->get();
        }
        return $users;
    }

    
}
