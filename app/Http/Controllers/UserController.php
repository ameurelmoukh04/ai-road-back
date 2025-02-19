<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'data not valide'], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $roleController = new RoleController();
        $roleController->assignRole($user);
        return response()->json(['message' => 'registered Succesfully', 'user' => $user,], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'credentials not valide'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'roles' => $user->roles()->pluck('name'),
            'token' => $token
        ]);
    }

    public function logout(Request $request){
        $user = Auth::user();

        if($user){
            $user->tokens()->delete();
            return response()->json(['message' => 'logged out succesfully'],200);
        }
        return response()->json(['message' => 'you are not Authenticated'],401);
    }
 

    public function admin(){
        return response()->json(['message' => 'Admin Dashboard']);
    }
}
