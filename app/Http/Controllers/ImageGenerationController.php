<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;

class ImageGenerationController extends Controller
{
    public function generateImage()
    {
        // $result = OpenAI::images()->create([
        //     'prompt' => 'A futuristic city floating in the sky',
        //     'n' => 1,
        //     'size' => '512x512',
        // ]);

        Storage::disk('public')->put('firstFile', 'empty');
        return response()->json(['message'=>'file saved']);

        //return $result->data[0]->url;
    }
}
