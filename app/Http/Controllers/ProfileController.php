<?php

namespace App\Http\Controllers;

use App\Models\Text;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(){
        $selectedUserPosts = Text::where('user_id',Auth::id())->get();
        
        if(Auth::check()){
            return $selectedUserPosts;
        }else{

            return response()->json(['profile'=>' not authenticated'],401);
        }
    }

    
}
