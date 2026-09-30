<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $cameras = Camera::where('user_id', Auth::id())->get(['id', 'name']);
        $categories = Category::where('user_id', Auth::id())->get(['id', 'name']);

        return view('admin.publish', ["categories" => $categories, "cameras" => $cameras, "isEdit" => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required|string|max:30',
            'desc' => 'required|string',
            'camera' => 'required|integer',
            'category' => 'required|array',
            'category.*' => 'integer',
        ]);

        $path = $request->file('picture')->store('pictures', 'public');

        $picture = Picture::create([
            'path' => $path,
            'title' => $validated['title'],
            'desc' => $validated['desc'],
            'camera_id' => $validated['camera'],
            'user_id' => Auth::id(),
        ]);

        $picture->categories()->attach($validated['category']);

        return redirect('/admin/publicações')
            ->with('success', 'A foto foi publicada!');
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
    public function edit(int $picture_id)
    {
        $cameras = Camera::where('user_id', Auth::id())->get(['id', 'name']);
        $categories = Category::where('user_id', Auth::id())->get(['id', 'name']);
        $pictureToEdit = Picture::find($picture_id);

        return view('admin.publish', ['isEdit' => true, 'pictureToEdit' => $pictureToEdit, "categories" => $categories, "cameras" => $cameras]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'pictureId' => 'required|integer|exists:pictures,id',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'required|string|max:30',
            'desc' => 'required|string',
            'camera' => 'required|integer',
            'category' => 'required|array',
            'category.*' => 'integer',
        ]);

        $picture = Picture::findOrFail($validated['pictureId']);

        $data = [
            'title' => $validated['title'],
            'desc' => $validated['desc'],
            'camera_id' => $validated['camera'],
        ];

        if ($request->hasFile('picture')) {
            $data['path'] = $request->file('picture')->store('pictures', 'public');
        }

        $picture->update($data);

        $picture->categories()->sync($validated['category']);

        return redirect()
            ->route('admin.gallery')
            ->with('success', 'Foto atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
