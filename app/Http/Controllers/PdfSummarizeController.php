<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use OpenAI\Laravel\Facades\OpenAI;
use Smalot\PdfParser\Parser;

class PdfSummarizeController extends Controller
{
    public function summarize(Request $request)
    {
        $id = FacadesAuth::id();

        $file = $request->file('pdf');
        $path = $request->file('pdf')->store('users/' . $id . '/pdfs', 'public');

        $parser = new Parser();
        $pdf = $parser->parseFile($file->getPathname());
        $content = $pdf->getText();

        $prompt = "summarize this pdf :" . $content;

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return $result->choices[0]
            ->message
            ->content;
    }
}
