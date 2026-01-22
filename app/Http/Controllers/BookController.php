<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Tampilkan semua buku
     */
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Tampilkan form tambah buku
     */
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Upload cover jika ada
        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // Simpan buku
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'cover' => $coverPath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail buku (opsional untuk sistem ini)
     */
    public function show(Book $book)
    {
        return redirect()->route('books.index');
    }

    /**
     * Tampilkan form edit buku
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update buku
     */
    public function update(Request $request, Book $book)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload cover baru jika ada
        $coverPath = $book->cover; // Gunakan cover lama secara default
        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($book->cover && file_exists(storage_path('app/public/' . $book->cover))) {
                unlink(storage_path('app/public/' . $book->cover));
            }
            // Upload cover baru
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        // Update buku
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year' => $request->year,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'cover' => $coverPath,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Hapus buku
     */
    public function destroy(Book $book)
    {
        // Cek apakah buku sedang dipinjam
        if ($book->loans()->where('status', 'dipinjam')->count() > 0) {
            return back()->with('error', 'Tidak bisa menghapus buku yang sedang dipinjam!');
        }

        // Hapus cover jika ada
        if ($book->cover && file_exists(storage_path('app/public/' . $book->cover))) {
            unlink(storage_path('app/public/' . $book->cover));
        }

        // Hapus buku
        $book->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}
