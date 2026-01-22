@extends('layouts.app')

@section('title', 'Edit Kategori - Sistem Perpustakaan')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-3xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
      <a href="{{ route('categories.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-4">
        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Kategori
      </a>
      <h1 class="text-3xl font-bold text-gray-900">Edit Kategori</h1>
      <p class="mt-1 text-sm text-gray-600">Ubah informasi kategori buku</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('categories.update', $category) }}" method="POST">
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

          <!-- Nama Kategori -->
          <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700">
              Nama Kategori <span class="text-red-500">*</span>
            </label>
            <div class="mt-1">
              <input type="text" name="name" id="name" required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Contoh: Fiksi, Non-Fiksi, Sains, dll."
                value="{{ old('name', $category->name) }}">
            </div>
            <p class="mt-1 text-sm text-gray-500">
              Berikan nama kategori yang deskriptif dan mudah dipahami
            </p>
          </div>

          <!-- Info Tambahan -->
          <div class="mb-6 bg-gray-50 rounded-md p-4">
            <div class="flex">
              <div class="shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-gray-900">
                  Kategori ini memiliki {{ $category->books->count() }} buku
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  Perubahan nama kategori akan diterapkan ke semua buku yang terkait.
                </p>
              </div>
            </div>
          </div>

          <!-- Submit Buttons -->
          <div class="flex justify-end space-x-3">
            <a href="{{ route('categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
              Batal
            </a>
            <button type="submit"
              class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Update Kategori
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection