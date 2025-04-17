<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImageGenerationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\TextController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');

Route::get('/', [TextController::class, 'index']);


Route::post('/check', [TextController::class, 'check']);

Route::get('/history', [HistoryController::class, 'history'])->middleware('auth:api');
Route::get('/history/show', [HistoryController::class, 'show']);


Route::post('/scan', [TextController::class, 'scan']);

Route::post('/image/generate', [ImageGenerationController::class, 'generateImage']);



