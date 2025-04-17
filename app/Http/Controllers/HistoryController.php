<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history(){
        $user = Auth::check();
        if($user){
            $history = Text::where('user_id', Auth::id())->get();
            return response()->json(['data'=> $history]);
        }
    }
    public function show(Request $request){
        $history_id=$request->id;
        $history = Text::where('id',$history_id)->first();
        return response()->json(['data'=> $history]);
    }
}
