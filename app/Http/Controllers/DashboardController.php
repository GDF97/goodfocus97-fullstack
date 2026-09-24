<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $picturesCount = Picture::where('user_id', $userId)->count("*");
        $camerasCount = Camera::where('user_id', $userId)->count("*");
        $categoryCount = Category::where('user_id', Auth::id())->count("*");
        $pictures = Picture::where('user_id', Auth::id())->get([
            'id',
            'path',
            'title',
            'user_id',
            'created_at'
        ]);

        return view('admin.dashboard', [
            'user' => $user,
            'picturesCount' => $picturesCount,
            'camerasCount' => $camerasCount,
            'categoryCount' => $categoryCount,
            'pictures' => $pictures,
        ]);
    }

    public function gallery()
    {
        return view('admin.gallery');
    }
}