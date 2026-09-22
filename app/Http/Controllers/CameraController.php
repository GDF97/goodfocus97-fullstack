<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $cameras = Camera::all()->where("user_id", $userId);
        return view('admin.cameras', ['cameras' => $cameras, 'isEdit' => false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'camera' => 'string|required'
        ]);
        $userId = Auth::id();

        Camera::create([
            'name' => $validated['camera'],
            'user_id' => $userId
        ]);

        return redirect('/admin/cameras')->with('success', 'Câmera cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Camera $camera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $camera_id)
    {
        $userId = Auth::id();
        $cameras = Camera::all()->where("user_id", $userId);
        $cameraToEdit = Camera::find($camera_id);

        return view('admin.cameras', ['cameras' => $cameras, 'isEdit' => true, 'cameraToEdit' => $cameraToEdit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Camera $camera)
    {
        $validated = $request->validate([
            'camera' => 'string|required|max:255',
            'cameraId' => 'int|required'
        ]);
        $camera->where('id', $validated['cameraId'])->update([
            "name" => $validated['camera']
        ]);
        $userId = Auth::id();
        $cameras = Camera::all()->where("user_id", $userId);
        return view('admin.cameras', ['cameras' => $cameras, 'isEdit' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Camera $camera)
    {
        //
    }
}
