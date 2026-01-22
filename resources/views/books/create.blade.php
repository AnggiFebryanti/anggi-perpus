@extends('layouts.app')

@section('title', 'Tambah Buku - Sistem Perpustakaan')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
      <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-4">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Buku
      </a>
      <h1 class="text-3xl font-bold text-gray-900">Tambah Buku Baru</h1>
      <p class="mt-1 text-sm text-gray-600">Masukkan informasi buku baru</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
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

          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <!-- Judul Buku -->
            <div class="sm:col-span-2">
              <label for="title" class="block text-sm font-medium text-gray-700">
                Judul Buku <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="text" name="title" id="title" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="Masukkan judul buku"
                  value="{{ old('title') }}">
              </div>
            </div>

            <!-- Penulis -->
            <div>
              <label for="author" class="block text-sm font-medium text-gray-700">
                Penulis <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="text" name="author" id="author" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="Masukkan nama penulis"
                  value="{{ old('author') }}">
              </div>
            </div>

            <!-- Kategori -->
            <div>
              <label for="category_id" class="block text-sm font-medium text-gray-700">
                Kategori <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <select name="category_id" id="category_id" required
                  class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="">-- Pilih Kategori --</option>
                  @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>

            <!-- Penerbit -->
            <div>
              <label for="publisher" class="block text-sm font-medium text-gray-700">
                Penerbit <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="text" name="publisher" id="publisher" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="Masukkan nama penerbit"
                  value="{{ old('publisher') }}">
              </div>
            </div>

            <!-- Tahun -->
            <div>
              <label for="year" class="block text-sm font-medium text-gray-700">
                Tahun Terbit <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="number" name="year" id="year" required min="1900" max="{{ date('Y') }}"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="{{ date('Y') }}"
                  value="{{ old('year') }}">
              </div>
            </div>

            <!-- Stok -->
            <div>
              <label for="stock" class="block text-sm font-medium text-gray-700">
                Stok <span class="text-red-500">*</span>
              </label>
              <div class="mt-1">
                <input type="number" name="stock" id="stock" required min="0"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  placeholder="0"
                  value="{{ old('stock') }}">
              </div>
            </div>

            <!-- Cover Buku -->
            <div class="sm:col-span-2">
              <label for="cover" class="block text-sm font-medium text-gray-700">
                Cover Buku
              </label>
              <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="cover" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                      <span>Upload a file</span>
                      <input id="cover" name="cover" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg,image/gif">
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs text-gray-500">
                    PNG, JPG, GIF up to 2MB
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
              Batal
            </a>
            <button type="submit"
              class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Simpan Buku
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection