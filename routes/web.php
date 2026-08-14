<?php

use App\Http\Controllers\CameraController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PictureController::class, 'index']);
Route::get('/create-picture', [PictureController::class, 'create']);
Route::post('/store-picture', [PictureController::class, 'store']);

Route::get('/login', [UserController::class, 'create']);
Route::post('/login', [UserController::class, 'store']);

Route::get('/logout', function(Request $request){
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
});

Route::get('/cameras', [CameraController::class, 'index']);
Route::post('/cameras', [CameraController::class, 'store']);