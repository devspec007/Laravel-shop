<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    public function login()
    {
       return view('frontend.customer.login');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        // $credentials['type'] = 'customer';
        if (Auth::attempt($credentials)) {
            if(!in_array(Auth::user()->type, ['customer', 'distributor'])) {
                Auth::logout();
                Session::flash('error',  'error');
                return response([ 'message' => 'Logged in unsuccessfully', 'status' => 'success']);
            }
            Session::flash('success',  'Logged in successfully');
            return response([ 'status' => 'success']);
        }
        Session::flash('error',  'error');
        return response([ 'message' => 'Logged in unsuccessfully', 'status' => 'success']);
    
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|min:6|max:12',
            'email' => 'required|email|unique:users',
            

        ]);
        $data = $request->only('name', 'email', 'contact');
        $data['password'] = bcrypt($request->password);
        $data['type'] = "customer";
        $data['created_by'] = Auth::id();
        $user = User::create($data);
        
        Session::flash('success', 'Thankyou register with us');
        return response(['status' => 'success']);
    }
}
