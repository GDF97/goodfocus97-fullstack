<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function(){
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/publicar-foto', [DashboardController::class, 'publishPhoto'])->name('admin.publish');
    Route::get('/admin/publicações', [DashboardController::class, 'gallery'])->name('admin.gallery');
    Route::get('/admin/cameras', [CameraController::class, 'index'])->name('admin.cameras');
});




// Route::get('/create-picture', [PictureController::class, 'create']);
// Route::post('/store-picture', [PictureController::class, 'store']);

// Route::get('/login', [UserController::class, 'create']);
// Route::post('/login', [UserController::class, 'store']);

// // Route::put();

// Route::get('/logout', function(Request $request){
//     Auth::logout();

//     $request->session()->invalidate();
//     $request->session()->regenerateToken();

//     return redirect('/');
// });

// Route::get('/cameras', [CameraController::class, 'index']);
// Route::post('/cameras', [CameraController::class, 'store']);