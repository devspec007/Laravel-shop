<?php

namespace App\Traits;

use App\Models\User;
use App\Models\UserProfile;
use Auth;
use Exception;
use Illuminate\Support\Str;
use Session;
use DB;
use Spatie\Permission\Models\Role;

trait UserTrait
{
    public function createUpdateSupplier($request, $id = null) {
        $image = '';
        $data = $request->only(['name', 'email', 'contact']);
        $data['created_by'] = Auth::id();
        $data['additional_data'] = json_encode($request->only(['gst_type', 'gst', 'pan_no', 'company_name']));
        if($id == null) {
        $data['type'] = 'supplier';
        $data['password'] = bcrypt($request->password);

            $user = User::create($data);
        }
        else {
            $data['status'] = $request->status;

            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            }
            $user = User::find($id);
            $user->update($data);
        }
        if(!$user->profile) {
            $user_profile = new UserProfile();
            $user_profile->user_id = $user->id;
           
        }
        else {
            $user_profile = $user->profile;
           
        }
        $user_profile->description = $request->description;
        $user_profile->state_id = $request->state;
        $user_profile->city_id = $request->city;
        $user_profile->address = $request->address;
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/user/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $user_profile->image = $image;
        }
        $user_profile->save();
       
    }

    public function createUpdateEmployee($request, $id = null) {
        $image = '';
        $data = $request->only(['name', 'email', 'contact']);
        $data['created_by'] = Auth::id();
        // $data['additional_data'] = json_encode($request->only(['gst_type', 'gst', 'pan_no', 'company_name']));
        if($id == null) {
        $data['type'] = 'employee';
        $data['password'] = bcrypt($request->password);

            $user = User::create($data);
            $role=Role::find($request->role_id);
            $user->assignRole($role);
        }
        else {
            $data['status'] = $request->status;

            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            }
            $user = User::find($id);
            $user->update($data);
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            $role=Role::find($request->role_id);
            $user->assignRole($role);
        }
        if(!$user->profile) {
            $user_profile = new UserProfile();
            $user_profile->user_id = $user->id;
           
        }
        else {
            $user_profile = $user->profile;
           
        }
        $user_profile->description = $request->description;
        $user_profile->state_id = $request->state;
        $user_profile->city_id = $request->city;
        $user_profile->address = $request->address;
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();
            $path = 'uploads/user/' . date('y/m');
            $request->image->move($path, $fileName);
            $image = $path . '/' . $fileName;
            $user_profile->image = $image;
        }
        $user_profile->save();
    }
}