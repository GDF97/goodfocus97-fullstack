<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::all()->where("user_id", $userId);
        return view('admin.category', ['categories' => $categories, 'isEdit' => false]);
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
        $validate = $request->validate([
                "category" => "string|max:255|required"
            ]);
        $userId = Auth::id();

        $existingCategory = Category::where('user_id', $userId)->where('name', $validate['category'])->exists();

        if($existingCategory)
        {
            return redirect()->route('admin.category.index')->with('warning', 'Categoria já cadastrada!');
        }

        try {
            Category::create([
                'name' => $validate['category'],
                'user_id' => $userId,
            ]);
        } catch (Throwable $th) {
            report($th);

            return redirect()
                ->route('admin.category.index')
                ->with('error', 'Não foi possível cadastrar categoria!');
        }

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Categoria cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $category_id)
    {
        $userId = Auth::id();
        $categories = Category::all()->where("user_id", $userId);
        $categoryToEdit = Category::find($category_id);

        return view('admin.category', ['categories' => $categories, 'isEdit' => true, 'categoryToEdit' => $categoryToEdit]);
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'categoryId' => 'required|integer',
        ]);

        $category = Category::where('user_id', Auth::id())
            ->findOrFail($validated['categoryId']);

        $existingCategory = Category::where('user_id', Auth::id())
            ->where('name', $validated['category'])
            ->where('id', '!=', $category->id)
            ->exists();

        if ($existingCategory) {
            return back()
                ->withInput()
                ->with('warning', 'Você já possui uma categoria com esse nome.');
        }

        try {
            $category->update([
                'name' => $validated['category'],
            ]);
        } catch (\Throwable $th) {
            report($th);

            return back()->with(
                'error',
                'Não foi possível atualizar a categoria. Tente novamente.'
            );
        }

        return redirect('/admin/categorias')
            ->with('success', 'Categoria atualizada com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $category_id)
    {
        $category = Category::where('user_id', Auth::id())
            ->findOrFail($category_id);

        try {
            $category->delete();
        } catch (\Throwable $th) {
            report($th);

            return back()->with(
                'error',
                'Não foi possível excluir a categoria.'
            );
        }

        return redirect('/admin/categorias')
            ->with('success', 'Categoria deletada com sucesso!');
    }
}
