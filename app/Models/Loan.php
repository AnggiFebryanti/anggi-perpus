<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'borrower_name',
        'loan_date',
        'return_date',
        'status',
    ];

    /**
     * Relasi: Peminjaman terkait dengan satu buku
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
