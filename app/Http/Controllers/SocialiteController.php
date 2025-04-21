<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log as FacadesLog;
use Laravel\Socialite\Facades\Socialite;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class SocialiteController extends Controller
{
    public function redirectToGoogle(): JsonResponse
{
    $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();

    return response()->json(['url' => $url]);
}
    public function handleGoogleCallBack(Request $request)
    {
        $request->validate([
            'code' => 'string|required'
        ]);
        try {
            $socialiteUser = Socialite::driver('google')->stateless()->user();
        } catch (ClientException $e) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        
        $user = User::query()
            ->firstOrCreate(
                [
                    'email' => $socialiteUser->getEmail(),
                ],
                [
                    'email_verified_at' => now(),
                    'name' => $socialiteUser->getName(),
                    'social_id' => $socialiteUser->getId(),
                    'social_type' => 'google',
                    'role' => 'user',
                    'password' => Hash::make('my-auth')
                ]
            );
            $token = JWTAuth::fromUser($user);
            FacadesLog::info($request->all());

            return response()->json([
                'status'=>'success',
                'user' => $user,
                'Authorization'=> [
                    'token'=> $token,
                    'type'=> 'Bearer',
                ]
                ], 200);
    }
}
