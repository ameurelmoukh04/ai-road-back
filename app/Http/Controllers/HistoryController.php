<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Pdf;
use App\Models\Text;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function historyText(){
        $user = Auth::check();
        if($user){
            $history = Text::where('user_id', Auth::id())->get();
            return response()->json(['data'=> $history]);
        }
    }
    

    public function historyPdf(){
        $user = Auth::check();
        if($user){
            $history= Pdf::where('user_id',Auth::id())->get();
            return response()->json(['data'=>$history]);
        }
    }
    public function historyImage(){
        $user = Auth::check();
        if($user){
            $imageHistory = Image::where('user_id', Auth::id())->get();
            return response()->json(['imageHistory'=>$imageHistory]);
        }
    }

    public function show(Request $request){
        $history_id=$request->id;
        $history = Text::where('id',$history_id)->first();
        return response()->json(['data'=> $history]);
    }

    public function deleteHistory(Request $request){
        $history_type = $request->history_type;
        $history_id = $request->history_id;
        $id = Auth::id();
        //return response()->json(['working']);
        if($history_type === 'text'){
            $text = Text::findorfail($history_id);
            if(Auth::id()==$text->user_id){
                $text->delete();
                return response()->json(['text'=>'deleted'],200);
            }else{
                return response()->json(['text'=>'you can not Delete'],401);
            }
            
        }elseif($history_type === 'pdf'){
            $pdf = Pdf::findorfail($history_id);
            if(Auth::id()==$pdf->user_id){
                $pdf->delete();
                return response()->json(['text'=>'deleted'],200);
            }else{
                return response()->json(['text'=>'you can not'],401);
            }
        }elseif($history_type === 'image'){
            $image = Image::findorfail($history_id);
            if(Auth::id()==$image->user_id){
                $image->delete();
                return response()->json(['text'=>'deleted'],200);
            }else{
                return response()->json(['text'=>'you can not'],401);
            }
        }

        
    }
}
