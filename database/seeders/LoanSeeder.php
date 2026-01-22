<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Get some books for the loans
    $dilan1990 = Book::where('title', 'Dilan 1990')->first();
    $laskarPelangi = Book::where('title', 'Laskar Pelangi')->first();
    $bumiManusia = Book::where('title', 'Bumi Manusia')->first();
    $saman = Book::where('title', 'Saman')->first();
    $garisWaktu = Book::where('title', 'Garis Waktu')->first();
    $negeri5Menara = Book::where('title', 'Negeri 5 Menara')->first();
    $filosofiTeras = Book::where('title', 'Filosofi Teras')->first();
    $supernova = Book::where('title', 'Supernova: Ksatria, Puteri, dan Bintang Jatuh')->first();
    $pulang = Book::where('title', 'Pulang')->first();
    $lelakiHarimau = Book::where('title', 'Lelaki Harimau')->first();

    $loans = [
      [
        'book_id' => $dilan1990->id,
        'borrower_name' => 'Budi Santoso',
        'loan_date' => Carbon::parse('2025-12-01'),
        'return_date' => Carbon::parse('2025-12-15'),
        'status' => 'dikembalikan',
      ],
      [
        'book_id' => $laskarPelangi->id,
        'borrower_name' => 'Siti Rahayu',
        'loan_date' => Carbon::parse('2025-12-10'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $bumiManusia->id,
        'borrower_name' => 'Ahmad Faisal',
        'loan_date' => Carbon::parse('2025-11-20'),
        'return_date' => Carbon::parse('2025-12-05'),
        'status' => 'dikembalikan',
      ],
      [
        'book_id' => $saman->id,
        'borrower_name' => 'Dewi Kartika',
        'loan_date' => Carbon::parse('2025-12-20'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $garisWaktu->id,
        'borrower_name' => 'Rizky Pratama',
        'loan_date' => Carbon::parse('2025-11-25'),
        'return_date' => Carbon::parse('2025-12-10'),
        'status' => 'dikembalikan',
      ],
      [
        'book_id' => $negeri5Menara->id,
        'borrower_name' => 'Maya Sari',
        'loan_date' => Carbon::parse('2025-12-15'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $filosofiTeras->id,
        'borrower_name' => 'Hendra Wijaya',
        'loan_date' => Carbon::parse('2025-12-05'),
        'return_date' => Carbon::parse('2025-12-20'),
        'status' => 'dikembalikan',
      ],
      [
        'book_id' => $supernova->id,
        'borrower_name' => 'Putri Maharani',
        'loan_date' => Carbon::parse('2025-11-30'),
        'return_date' => Carbon::parse('2025-12-14'),
        'status' => 'dikembalikan',
      ],
      [
        'book_id' => $pulang->id,
        'borrower_name' => 'Doni Setiawan',
        'loan_date' => Carbon::parse('2025-12-18'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $lelakiHarimau->id,
        'borrower_name' => 'Rina Amalia',
        'loan_date' => Carbon::parse('2025-12-08'),
        'return_date' => Carbon::parse('2025-12-22'),
        'status' => 'dikembalikan',
      ],
      // Additional active loans
      [
        'book_id' => $dilan1990->id,
        'borrower_name' => 'Ferdi Nugraha',
        'loan_date' => Carbon::parse('2026-01-05'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $laskarPelangi->id,
        'borrower_name' => 'Linda Kusuma',
        'loan_date' => Carbon::parse('2026-01-08'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $bumiManusia->id,
        'borrower_name' => 'Eko Prasetyo',
        'loan_date' => Carbon::parse('2026-01-03'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $garisWaktu->id,
        'borrower_name' => 'Winda Putri',
        'loan_date' => Carbon::parse('2026-01-10'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $saman->id,
        'borrower_name' => 'Agus Setiawan',
        'loan_date' => Carbon::parse('2025-12-25'),
        'return_date' => Carbon::parse('2026-01-08'),
        'status' => 'dikembalikan',
      ],
      [
        'book_id' => $negeri5Menara->id,
        'borrower_name' => 'Rina Melati',
        'loan_date' => Carbon::parse('2026-01-02'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $filosofiTeras->id,
        'borrower_name' => 'Bambang Sutrisno',
        'loan_date' => Carbon::parse('2025-12-28'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
      [
        'book_id' => $supernova->id,
        'borrower_name' => 'Sari Wulandari',
        'loan_date' => Carbon::parse('2026-01-06'),
        'return_date' => null,
        'status' => 'dipinjam',
      ],
    ];

    foreach ($loans as $loan) {
      Loan::create($loan);
    }
  }
}
