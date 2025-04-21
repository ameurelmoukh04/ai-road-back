<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImageGenerationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TextController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

Route::get('auth', [SocialiteController::class, 'redirectToGoogle']);
Route::post('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('/checkout', CheckoutController::class);

Route::get('thankyoupage',function (){
    return response()->json('thank you for subscribing');
})->name('thankyoupage');

Route::get('cancel',function (){
    return response()->json('canceled');
})->name('cancel');


Route::get('/', [TextController::class, 'index']);


Route::post('/check', [TextController::class, 'check']);

Route::get('/history/text', [HistoryController::class, 'historyText'])->middleware('auth:api');
Route::get('/history/pdf', [HistoryController::class, 'historyPdf'])->middleware('auth:api');
Route::get('/history/show', [HistoryController::class, 'show']);

Route::delete('/history/delete', [HistoryController::class, 'history']);


Route::post('/scan', [TextController::class, 'scan']);

Route::post('/image/generate', [ImageGenerationController::class, 'generateImage']);


Route::post('/profile', [ProfileController::class, 'profile']);



