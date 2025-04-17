<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate( [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:4',
            //'role' => 'required|string|in:admin,user,business '
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = 'user';
        $user->password = Hash::make($request->password);
        $user->save();

        
        $token= Auth::login($user);
         
        //$roleController = new RoleController();
        //$roleController->assignRole($user);
        return response()->json([
            'message' => 'registered Succesfully',
            'user' => $user,
            'Authorization'=> [
                'token'=> $token,
                'type'=> 'Bearer',
            ]
            ], 201);
   
    }
    public function test(){
        return response()->json(['data'=>'test']);
    }

    public function login(Request $request){
        $credentials= $request->only('email','password');

        $token = Auth::attempt($credentials);
        if(!$token){
            return response()->json([
                'status'=>'error',
                'message'=> 'Login not valide'
            ],401);
        }
        $user = Auth::user();
        return response()->json([
            'status'=>'success',
            'user' => $user,
            'Authorization'=> [
                'token'=> $token,
                'type'=> 'Bearer',
            ]
            ], 200);
    }

    public function logout(){
        Auth::logout();
        return response()->json([
            'status'=>'success',
            'message'=>'succesfully logged out'
        ],200);
    }

    public function refresh(){
        return response()->json([
            'message' => 'refreshed Succesfully',
            'user' => Auth::user(),
            'Authorization'=> [
                'token'=> Auth::refresh(),
                'type'=> 'Bearer',
            ]
            ], 200);
    }
}
