<?php

use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
