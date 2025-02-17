<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        $user->roles()->attach($role);
        return response()->json(['message' => 'Role assigned successfully']);
    }
}
