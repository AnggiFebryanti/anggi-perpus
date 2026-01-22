@extends('layouts.app')

@section('title', 'Kembalikan Buku - Sistem Perpustakaan')

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
      <h1 class="text-3xl font-bold text-gray-900">Kembalikan Buku</h1>
      <p class="mt-1 text-sm text-gray-600">Proses pengembalian buku</p>
    </div>

    <!-- Info Card -->
    <div class="bg-white shadow rounded-lg mb-6">
      <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Peminjaman</h3>
        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
          <div>
            <dt class="text-sm font-medium text-gray-500">Judul Buku</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $loan->book->title }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500">Penulis</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $loan->book->author }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500">Peminjam</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $loan->borrower_name }}</dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500">Tanggal Pinjam</dt>
            <dd class="mt-1 text-sm text-gray-900">
              {{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}
            </dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500">Status</dt>
            <dd class="mt-1">
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                Dipinjam
              </span>
            </dd>
          </div>
          <div>
            <dt class="text-sm font-medium text-gray-500">Stok saat ini</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $loan->book->stock }} buku</dd>
          </div>
        </dl>
      </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('loans.update', $loan) }}" method="POST">
          @csrf
          @method('PUT')

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
            <!-- Tanggal Kembali -->
            <div>
              <label for="return_date" class="block text-sm font-medium text-gray-700">
                Tanggal Pengembalian <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="date" name="return_date" id="return_date" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  value="{{ old('return_date', date('Y-m-d')) }}">
              </div>
            </div>

            <!-- Info -->
            <div class="bg-green-50 rounded-md p-4">
              <div class="flex">
                <div class="shrink-0">
                  <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                </div>
                <div class="ml-3">
                  <h3 class="text-sm font-medium text-gray-900">
                    Konfirmasi Pengembalian
                  </h3>
                  <div class="mt-2 text-sm text-gray-700">
                    <ul class="list-disc pl-5 space-y-1">
                      <li>Stok buku akan bertambah secara otomatis</li>
                      <li>Status peminjaman akan berubah menjadi "Dikembalikan"</li>
                      <li>Pastikan buku dalam kondisi baik</li>
                      <li>Stok akan menjadi: {{ $loan->book->stock + 1 }} buku</li>
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
              class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              Konfirmasi Pengembalian
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection