<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\Text;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use OpenAI\Laravel\Facades\OpenAI;
use Smalot\PdfParser\Parser;
use Validator;

class TextController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function check(Request $request)
    {

        $request->validate([
            'content' => 'required|string|min:200|max:500'
        ]);

        $content = $request->content;
        $prompt = "Analyze the following text and determine the likelihood that it was generated by AI. 
        Return only a number from 0 to 100 representing the AI-written percentage. 
        Do not include any other words, symbols, or explanations.  
        Text: " . $content;

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        if (Auth::check()) {
            $id = Auth::id();
            $text = new Text();
            $text->user_id = $id;
            $text->content = $request->content;

            if (isset($result->choices[0]->message->content)) {
                $text->result = $result->choices[0]->message->content;
            } else {
                $text->result = null;
            }
            $text->save();

            $history = Text::where('user_id', $id)->get();
            return response()->json([
                'data' => $result->choices[0]->message->content,
                'userId' => $id,
                'history' => $history
            ]);
        }



        return response()->json(['data' => $result->choices[0]->message->content]);
    }

    public function scan(Request $request)
    {
        $id = Auth::user()->id;

        $file = $request->file('pdf');
        $path = $request->file('pdf')->store('users/'. $id .'/pdfs', 'public');

        $parser = new Parser();
        $pdf = $parser->parseFile($file->getPathname());
        $content = $pdf->getText();
        $prompt = "Analyze the following text and determine the likelihood that it was generated by AI. 
        Return only a number from 0 to 100 representing the AI-written percentage. 
        Do not include any other words, symbols, or explanations.  
        Text: " . $content;

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $pdf = new Pdf();
        $pdf->user_id = $id;
        $pdf->filename = $file->getClientOriginalName();
        $pdf->content = $content;
        $pdf->path = $path;
        if (isset($result->choices[0]->message->content)) {
            $pdf->result = $result->choices[0]->message->content;
        } else {
            $pdf->result = 'no result';
        }
        $pdf->save();

        return response()->json([
            'data' => $result->choices[0]->message->content,
            'content' => $content,
            'filename' => $file->getClientOriginalName(),
            'user_id' => $id
        ]);
    }
}
