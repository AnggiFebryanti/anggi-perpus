<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Tampilkan semua riwayat peminjaman
     */
    public function index()
    {
        $loans = Loan::with('book')->latest()->paginate(10);
        return view('loans.index', compact('loans'));
    }

    /**
     * Tampilkan form peminjaman buku
     */
    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('loans.create', compact('books'));
    }

    /**
     * Proses peminjaman buku
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrower_name' => 'required|string|max:255',
            'loan_date' => 'required|date|before_or_equal:today',
        ]);

        // Cek ketersediaan buku
        $book = Book::find($request->book_id);
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia!');
        }

        // Kurangi stok buku
        $book->decrement('stock');

        // Catat peminjaman
        Loan::create([
            'book_id' => $request->book_id,
            'borrower_name' => $request->borrower_name,
            'loan_date' => $request->loan_date,
            'return_date' => null,
            'status' => 'dipinjam',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('loans.index')
            ->with('success', 'Buku berhasil dipinjam ke ' . $request->borrower_name . '!');
    }

    /**
     * Tampilkan detail peminjaman (opsional)
     */
    public function show(Loan $loan)
    {
        return redirect()->route('loans.index');
    }

    /**
     * Tampilkan form pengembalian buku
     */
    public function edit(Loan $loan)
    {
        // Cek apakah buku sudah dikembalikan
        if ($loan->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan!');
        }

        $loan->load('book');
        return view('loans.edit', compact('loan'));
    }

    /**
     * Proses pengembalian buku
     */
    public function update(Request $request, Loan $loan)
    {
        // Cek apakah buku sudah dikembalikan
        if ($loan->status === 'dikembalikan') {
            return back()->with('error', 'Buku sudah dikembalikan!');
        }

        // Validasi tanggal pengembalian
        $request->validate([
            'return_date' => 'required|date|after_or_equal:loan_date',
        ]);

        // Tambah stok buku
        $loan->book->increment('stock');

        // Update status peminjaman
        $loan->update([
            'return_date' => $request->return_date,
            'status' => 'dikembalikan',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('loans.index')
            ->with('success', 'Buku berhasil dikembalikan! Stok sekarang: ' . $loan->book->stock);
    }

    /**
     * Hapus riwayat peminjaman
     */
    public function destroy(Loan $loan)
    {
        // Cek apakah buku masih dipinjam
        if ($loan->status === 'dipinjam') {
            return back()->with('error', 'Tidak bisa menghapus peminjaman yang masih aktif!');
        }

        // Hapus riwayat
        $loan->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('loans.index')
            ->with('success', 'Riwayat peminjaman berhasil dihapus!');
    }
}
