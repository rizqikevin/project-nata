<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'warna' => 'required|max:7',
            'deskripsi' => 'nullable'
        ]);

        $validated['user_id'] = auth()->id();
        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dibuat');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'warna' => 'required|max:7',
            'deskripsi' => 'nullable'
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}