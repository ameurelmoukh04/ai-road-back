<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class TextController extends Controller
{
    public function index(){
        return view('home');
    }

    public function check(Request $request){
        $content = $request->content;
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => 'Hello chatgpt, I will give a text and you will analyse it and give me just in return the ai written percentage [just the value,I dont want other text because I will need this value to do some calculations without the % tag too],this is the text' . $content],
                ],
            ]);

            return response()->json(['data' => $result->choices[0]->message->content]);
    }
}
