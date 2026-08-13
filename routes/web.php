<?php

use App\Http\Controllers\CameraController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PictureController::class, 'index']);
Route::get('/create-picture', [PictureController::class, 'create']);
Route::post('/store-picture', [PictureController::class, 'store']);


Route::get('/cameras', [CameraController::class, 'index']);
Route::post('/cameras', [CameraController::class, 'store']);