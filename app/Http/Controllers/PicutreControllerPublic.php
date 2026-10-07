<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Picture; 
use Illuminate\Http\Request;

class PicutreControllerPublic extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cameras = Camera::get("*")->where('user_id', 1);
        $pictures = Picture::latest()->take(10)->where('user_id', 1)->get();
        return view("home", ["pictures" => $pictures, "cameras" => $cameras]);
    }


    /**
     * Display the specified resource.
     */
    public function showOnePicture(Picture $picture, int $picture_id)
    {
        $showPicture = $picture->find($picture_id);
        $latestPictures = Picture::latest()->take(10)->where('user_id', 1)->get();
        return view("public.picture", ['picture' => $showPicture, 'pictures' => $latestPictures]);
    }

    public function showGallery(Picture $picture)
    {
        $allPictures = $picture->get("*")->where('user_id', 1);

        return view("public.gallery", ["pictures" => $allPictures]);
    }
}
