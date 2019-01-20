<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json(['data'=>$users], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|confirmed',
        ];

        $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $date['admin'] = User::REGULAR_USER;

        $user = User::create($data);

        return response()->json(['data'=>$user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {   
        $user = User::find($user);
        if (is_null($user)) {
            return response()->json(['data'=>'User Not Found'], 200);
        }
        return response()->json(['data'=>$user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users, email,'.$user->id,
            'password'=>'required|min:5|confirmed',
            'admin'=>'in:'.User::ADMIN_USER.','.User::REGULAR_USER,
        ];

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return response()->json(['error'=>'Only Verified users can perform this action', 'code'=>409], 409);
            }

            $user->admin = $request->admin;
        }

        if(!$user->isDirty()){
            return response()->json(['error'=>'You need to specify a different value to update', 'code'=>422], 422);
        }

        $user->save();
        return response()->json(['data'=>$user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['data'=>'User deleted successfully'], 200);
    }
}
