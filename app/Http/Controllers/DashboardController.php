<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\Loan;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard dengan statistik
     */
    public function index()
    {
        // Hitung total data untuk statistik
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalLoans = Loan::count();
        $loansActive = Loan::where('status', 'dipinjam')->count();

        return view('dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalLoans',
            'loansActive'
        ));
    }
}
