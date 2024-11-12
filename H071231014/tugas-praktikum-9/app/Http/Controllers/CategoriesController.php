<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Categories::all();
        return view('categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('categories.create');
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categories::create($request->all());

        return redirect()->route('categories.index')->with('success', 'categories$categories created successfully.');
    }

    // Menampilkan detail kategori untuk diedit
    public function edit(Categories $categories)
    {
        return view('categories.edit', compact('categories'));
    }

    // Memperbarui data kategori
    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $categories->update($request->all());

        return redirect()->route('categories updated successfully.');
    }

    // Menghapus kategori
    public function destroy(Categories $categories)
    {
        $categories->delete();

        return redirect()->route('categories.index')->with('success', 'categories deleted successfully.');
    }
}