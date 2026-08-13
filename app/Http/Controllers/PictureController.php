<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pictures = Picture::with('user')->latest()->take(5)->get();
        return view('home', ["pictures" => $pictures]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cameras = Camera::all();
        return view('create-picture', ['cameras' => $cameras]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required|string|max:30',
            'desc' => 'required|string',
            'camera' => 'required|integer',
        ]);

        $path = $request->file('path')->store('pictures', 'public');

        Picture::create([
            'path' => $path,
            'title' => $validated['title'],
            'desc' => $validated['desc'],
            'camera_id' => $validated['camera'],
            'user_id' => "1",
        ]);

        return redirect('/')->with("success", "A foto foi publicada!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
