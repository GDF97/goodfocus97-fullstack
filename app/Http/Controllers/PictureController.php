<?php

namespace App\Http\Controllers;

use App\Models\Camera;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

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
        $validated = $request->validate(
            [
                'picture' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
                'title' => 'required|string|max:30',
                'desc' => 'required|string',
                'camera' => [
                    'required',
                    'integer',
                     Rule::exists('cameras', 'id')->where('user_id', Auth::id()),
                ],
                'category' => 'required|array',
                'category.*' => [
                    'required',
                    'integer',
                    Rule::exists('categories', 'id')
                        ->where('user_id', Auth::id()),
                    ],
            ],
            [
                'picture.required' => 'Nenhuma imagem foi selecionada.',
                'title.required' => 'O titulo é obrigatório',
            ]
        );

        $path = null;

        try {
            $path = $request->file('picture')->store('pictures', 'public');

            if (!$path) {
                throw new \RuntimeException(
                    'Não foi possível armazenar a imagem.'
                );
            }

             DB::transaction(function () use ($validated, $path) {
                $picture = Picture::create([
                    'path' => $path,
                    'title' => $validated['title'],
                    'desc' => $validated['desc'],
                    'camera_id' => $validated['camera'],
                    'user_id' => Auth::id(),
                ]);

                $picture->categories()->attach(
                    $validated['category']
                );
            });

            return redirect()
                ->route('admin.gallery')
                ->with('success', 'A foto foi publicada!');
        } catch (Throwable $th) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }

            report($th);

            return back()
                ->withInput($request->except('picture'))
                ->with('error', 'Não foi possível publicar a foto. Tente novamente.');
        }
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
        $pictureToEdit = Picture::findOrFail($picture_id);

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

        $picture = Picture::where('user_id', Auth::id())->findOrFail($validated['pictureId']);
        $oldPath = $picture->path;
        $newPath = null;

        try {
            if ($request->hasFile('picture')) {
                $newPath = $request->file('picture')
                    ->store('pictures', 'public');

                if (!$newPath) {
                    throw new \RuntimeException(
                        'Não foi possível armazenar a nova imagem.'
                    );
                }
            }

            DB::transaction(function () use (
                $picture,
                $validated,
                $newPath
            ) {
                $data = [
                    'title' => $validated['title'],
                    'desc' => $validated['desc'],
                    'camera_id' => $validated['camera'],
                ];

                if ($newPath !== null) {
                    $data['path'] = $newPath;
                }

                $picture->update($data);

                $picture->categories()->sync(
                    $validated['category']
                );
            });

        } catch (Throwable $th) {
            if ($newPath !== null) {
                try {
                    Storage::disk('public')->delete($newPath);
                } catch (Throwable $cleanupError) {
                    report($cleanupError);
                }
            }

            throw $th;
        }
        if ($newPath !== null) {
            try {
                Storage::disk('public')->delete($oldPath);
            } catch (Throwable $e) {
                report($e);
            }
        }

        return redirect()
            ->route('admin.gallery')
            ->with('success', 'Foto atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $picture_id)
    {
        $picture = Picture::where('user_id', Auth::id())
            ->findOrFail($picture_id);

        $path = $picture->path;

        DB::transaction(function () use ($picture) {
            $picture->categories()->detach();
            $picture->delete();
        });

        try {
            Storage::disk('public')->delete($path);
        } catch (Throwable $e) {
            report($e);
        }

        return redirect()
            ->route('admin.gallery')
            ->with('success', 'Foto excluída com sucesso!');
    }
}
