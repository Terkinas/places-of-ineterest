<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/test', function () {
    return response()->json(['status' => 'test successful']);
});

Route::post('/sanctum/token', [AuthController::class, 'mobile_login']);

Route::post('/post-upload', [PostController::class, 'index']);
Route::post('/locations/list', [LocationController::class, 'onlyLocations']);
Route::middleware('auth:sanctum')->post('/upload', [PostController::class, 'store']);
Route::middleware('auth:sanctum')->post('/posts/delete/{id}', [PostController::class, 'delete']);
Route::middleware('auth:sanctum')->post('/posts/adminRequest', [PostController::class, 'indexAdmin']);
Route::middleware('auth:sanctum')->post('/posts/request', [PostController::class, 'index']);
Route::middleware('auth:sanctum')->post('/posts/personal', [PostController::class, 'personal']);

Route::middleware('auth:sanctum')->delete('/delete', [AuthController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// location
Route::middleware('auth:sanctum')->post('/location/store', [LocationController::class, 'store']);

Route::get('/locations/request', [LocationController::class, 'index']);
Route::middleware('auth:sanctum')->get('/locations/adminRequest', [LocationController::class, 'indexAdmin']);
Route::middleware('auth:sanctum')->post('/locations/delete/{id}', [LocationController::class, 'delete']);

Route::get('/posts/{locationId}', [PostController::class, 'indexArray']);
