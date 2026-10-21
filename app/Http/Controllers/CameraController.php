<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

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
            'camera' => 'required|string',
        ]);

        $userId = Auth::id();

        $existingCamera = Camera::where('name', $validated['camera'])
            ->where('user_id', $userId)
            ->exists();

        if ($existingCamera) {
            return redirect()
                ->route('admin.cameras.index')
                ->with('warning', 'Essa câmera já está cadastrada.');
        }

        try {
            Camera::create([
                'name' => $validated['camera'],
                'user_id' => $userId,
            ]);
        } catch (\Throwable $th) {
            report($th);

            return back()->with(
                'error',
                'Não foi possível cadastrar a câmera. Tente novamente.'
            );
        }

        return redirect()
            ->route('admin.cameras.index')
            ->with('success', 'Câmera cadastrada com sucesso!');
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
    
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'camera' => 'required|string|max:255',
            'cameraId' => 'required|integer',
        ]);

        $camera = Camera::where('user_id', Auth::id())
            ->findOrFail($validated['cameraId']);

        $existingCamera = Camera::where('user_id', Auth::id())
            ->where('name', $validated['camera'])
            ->where('id', '!=', $camera->id)
            ->exists();

        if ($existingCamera) {
            return back()
                ->withInput()
                ->with('warning', 'Você já possui uma câmera com esse nome.');
        }

        try {
            $camera->update([
                'name' => $validated['camera'],
            ]);
        } catch (\Throwable $th) {
            report($th);

            return back()->with(
                'error',
                'Não foi possível atualizar a câmera. Tente novamente.'
            );
        }

        return redirect()
            ->route('admin.cameras.index')
            ->with('success', 'Câmera atualizada com sucesso!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $camera_id)
    {
        $camera = Camera::where('user_id', Auth::id())
            ->findOrFail($camera_id);

        try {
            $camera->delete();
        } catch (\Throwable $th) {
            report($th);

            return back()->with(
                'error',
                'Não foi possível excluir a câmera.'
            );
        }

        return redirect('/admin/cameras')
            ->with('success', 'Câmera deletada com sucesso!');
    }
}
