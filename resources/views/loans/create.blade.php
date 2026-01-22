@extends('layouts.app')

@section('title', 'Pinjam Buku - Sistem Perpustakaan')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
      <a href="{{ route('loans.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-4">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Peminjaman
      </a>
      <h1 class="text-3xl font-bold text-gray-900">Pinjam Buku Baru</h1>
      <p class="mt-1 text-sm text-gray-600">Catat peminjaman buku</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('loans.store') }}" method="POST">
          @csrf

          <!-- Error Messages -->
          @if ($errors->any())
          <div class="mb-4 rounded-md bg-red-50 p-4">
            <div class="flex">
              <div class="shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                  Ada {{ $errors->count() }} error yang perlu diperbaiki:
                </h3>
                <div class="mt-2 text-sm text-red-700">
                  <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @endif

          <div class="grid grid-cols-1 gap-6">
            <!-- Pilih Buku -->
            <div>
              <label for="book_id" class="block text-sm font-medium text-gray-700">
                Buku <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <select name="book_id" id="book_id" required
                  class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">-- Pilih Buku --</option>
                  @foreach($books as $book)
                  <option value="{{ $book->id }}" data-stock="{{ $book->stock }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                    {{ $book->title }} ({{ $book->author }})
                  </option>
                  @endforeach
                </select>
                @if($books->isEmpty())
                <p class="mt-1 text-sm text-gray-500">
                  Tidak ada buku yang tersedia. <a href="{{ route('books.create') }}" class="text-indigo-600 hover:text-indigo-900">Tambah buku baru</a>
                </p>
                @endif
              </div>
            </div>

            <!-- Informasi Buku Dipilih (akan muncul via JavaScript) -->
            <div id="book-info" class="hidden bg-blue-50 rounded-md p-4">
              <div class="flex">
                <div class="shrink-0">
                  <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <h3 class="text-sm font-medium text-gray-900">
                    Stok buku yang tersedia: <span id="stock-display" class="font-bold">0</span>
                  </h3>
                </div>
              </div>
            </div>

            <!-- Nama Peminjam -->
            <div>
              <label for="borrower_name" class="block text-sm font-medium text-gray-700">
                Nama Peminjam <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="text" name="borrower_name" id="borrower_name" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="Masukkan nama peminjam"
                  value="{{ old('borrower_name') }}">
              </div>
            </div>

            <!-- Tanggal Pinjam -->
            <div>
              <label for="loan_date" class="block text-sm font-medium text-gray-700">
                Tanggal Pinjam <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="date" name="loan_date" id="loan_date" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  value="{{ old('loan_date', date('Y-m-d')) }}">
              </div>
            </div>

            <!-- Info -->
            <div class="bg-yellow-50 rounded-md p-4">
              <div class="flex">
                <div class="shrink-0">
                  <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <h3 class="text-sm font-medium text-gray-900">
                    Catatan Penting
                  </h3>
                  <div class="mt-2 text-sm text-gray-700">
                    <ul class="list-disc pl-5 space-y-1">
                      <li>Stok buku akan berkurang secara otomatis</li>
                      <li>Pastikan tanggal pinjam tidak melebihi hari ini</li>
                      <li>Gunakan nama peminjam yang jelas dan benar</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('loans.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
              Batal
            </a>
            <button type="submit"
              class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Proses Peminjaman
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const bookSelect = document.getElementById('book_id');
    const bookInfo = document.getElementById('book-info');
    const stockDisplay = document.getElementById('stock-display');

    bookSelect.addEventListener('change', function() {
      const selectedOption = this.options[this.selectedIndex];
      const stock = selectedOption.getAttribute('data-stock');

      if (stock !== null) {
        stockDisplay.textContent = stock;
        bookInfo.classList.remove('hidden');
      } else {
        bookInfo.classList.add('hidden');
      }
    });
  });
</script>
@endsection