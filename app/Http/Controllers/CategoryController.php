<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        Category::create([
            "name" => $validate['category'],
            "user_id" => $userId
        ]);

        return redirect('/admin/categorias')->with('success', 'Câmera cadastrada com sucesso');

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
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category' => 'string|required|max:255',
            'categoryId' => 'int|required'
        ]);
        $category->where('id', $validated['categoryId'])->update([
            "name" => $validated['category']
        ]);
        $userId = Auth::id();
        $categories = Category::all()->where("user_id", $userId);
        return view('admin.category', ['categories' => $categories, 'isEdit' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        
    }
}
