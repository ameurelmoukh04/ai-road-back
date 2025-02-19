<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function assignRole(User $user)
    {
        $user = User::find($user->id);
        $role = Role::where('id', 1)->first();

        if($role){
            $user->roles()->attach($role->id);

            return response()->json(['message' => 'Role assigned successfully']);
        }

    }
}
