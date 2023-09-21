<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Spatie\Permission\Models\Role;
use DB;
use Exception;
use App\Traits\UserTrait;
class UserController extends Controller
{
    use UserTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $users = User::getEmployees(true, $request);
        return view('admin.user.userlist', compact('request', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.user.adduser', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|max:255',
            // 'image'=>'nullable|mimes:jpg,jpeg,gif,png',
            'password'=>'required',
            'email'=>'required|unique:users|email',
            'contact'=>'required|numeric|digits:10|unique:users', 
        ]);
        try {
            // throw new Exception('This Offset already exist');
            $this->createUpdateEmployee($request);
            Session::flash('Success', 'User created successfully');
            return response(['status' => 'success','url' => route('admin.user.index')]);
        }
        catch(Exception $exception) {
            $error['errors']['error'] = $exception->getMessage();
            return response()->json($error, 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = Place::where('type')->get();
        // $user = User::where(['id' => $id, 'type' => 'user'])->first();
        $user = User::where(['id' => $id])->first();

        if($user) {
            $roles = Role::get();

            return view('admin.user.edituser', compact('user', 'states', 'roles'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'nullable|min:6|max:12',
            'email' => 'required|email|unique:users,email,' . $id,
            'contact' => 'required|numeric|digits:10|unique:users,contact,' . $id, 
        ]);
        try {
            $this->createUpdateEmployee($request, $id);
            Session::flash('success', 'user is updated successfully');
            return response(['status' => 'success' , 'url' => route('admin.user.index')]);
        }
        catch(Exception $exception) {
            $error['errors']['error'] = $exception->getMessage();
            return response()->json($error, 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'User successfully deleted');
        return response(['status' => 'success']);
    }
}
