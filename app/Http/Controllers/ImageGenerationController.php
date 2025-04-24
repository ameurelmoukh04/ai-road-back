<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use OpenAI\Laravel\Facades\OpenAI;

class ImageGenerationController extends Controller
{
    public function generateImage(Request $request)
    {
        $prompt = $request->prompt;
        $size = $request->size;

        $id = Auth::id();

        $result = OpenAI::images()->create([
            //'model' => 'dall-e-3',
            'prompt' => $prompt,
            'n' => 1,
            'size' => $size,
        ]);

        $imageContent = Http::get($result['data'][0]['url'])->body();
        $filename = 'image_' . time() . '.png';
        $path = 'users/' . $id . '/images/' . $filename;
        
        Storage::disk('public')->put($path, $imageContent);

        $newImage = new Image();
        $newImage->user_id= $id;
        $newImage->prompt= 'real pc photo';
        $newImage->size = $size;
        $newImage->path = $path;
        $newImage->save();

        return response()->json([
            'message' => 'saved',
            'user_id' => $id,
            'filename' => $filename,
            'path' => $path
        ]);
        //return $result->data[0]->url;
    }
}
