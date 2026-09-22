<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\CategoryController;
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
    
    Route::get('/admin/cameras', [CameraController::class, 'index'])->name('admin.cameras.index');
    Route::post('/admin/cameras', [CameraController::class, 'store'])->name('admin.cameras.store');
    Route::get('/admin/cameras/{camera_id}/editar', [CameraController::class, 'edit'])->name('admin.cameras.edit');
    Route::put('/admin/cameras', [CameraController::class, 'update'])->name('admin.cameras.update');
    Route::get('/admin/cameras/{camera_id}/deletar', [CameraController::class, 'destroy'])->name('admin.cameras.destroy');
    
    
    Route::get('/admin/categorias', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/admin/categorias', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/categorias/{category_id}/editar', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/categorias', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/admin/categorias/{category_id}/deletar', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

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