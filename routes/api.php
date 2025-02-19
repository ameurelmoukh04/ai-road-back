<?php

use App\Http\Controllers\TextController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/', [TextController::class, 'index']);


Route::post('/check', [TextController::class, 'check']);
Route::post('/scan', [TextController::class, 'scan']);


Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin-dashboard', [UserController::class, 'admin'])->middleware('role:admin');
});
