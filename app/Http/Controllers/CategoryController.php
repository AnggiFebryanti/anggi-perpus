<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Tampilkan form tambah kategori
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan kategori
        Category::create([
            'name' => $request->name,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kategori (opsional untuk sistem ini)
     */
    public function show(Category $category)
    {
        return redirect()->route('categories.index');
    }

    /**
     * Tampilkan form edit kategori
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update kategori
        $category->update([
            'name' => $request->name,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori
     */
    public function destroy(Category $category)
    {
        // Cek apakah ada buku yang terkait
        if ($category->books()->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus kategori yang memiliki buku!');
        }

        // Hapus kategori
        $category->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
