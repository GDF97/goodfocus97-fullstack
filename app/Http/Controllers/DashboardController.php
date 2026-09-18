<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $picturesCount = Picture::where('user_id', Auth::id())->count("*");
        $camerasCount = Camera::count("id");
        $categoryCount = 10;
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
}