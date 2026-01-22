@extends('layouts.app')

@section('title', 'Selamat Datang - Sistem Perpustakaan')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-16rem)] px-4 py-12">
    <div class="max-w-4xl w-full">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Sistem Manajemen Perpustakaan</h1>
            <p class="text-xl text-gray-600 mb-8">Kelola buku, kategori, dan peminjaman dengan mudah dan efisien</p>

            @guest
            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-150 shadow-lg">
                Masuk ke Sistem
            </a>
            @endguest
        </div>

        <!-- Features -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-150">
                <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Manajemen Buku</h3>
                <p class="text-gray-600">Kelola koleksi buku lengkap dengan kategori, penulis, dan informasi penerbit</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-150">
                <div class="flex items-center justify-center w-12 h-12 bg-purple-100 rounded-full mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Peminjaman</h3>
                <p class="text-gray-600">Catat peminjaman dan pengembalian buku dengan tracking stok otomatis</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-150">
                <div class="flex items-center justify-center w-12 h-12 bg-orange-100 rounded-full mb-4">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Kategori</h3>
                <p class="text-gray-600">Organisasi buku ke dalam kategori yang mudah dicari dan dikelola</p>
            </div>
        </div>

        <!-- Tech Stack -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Teknologi yang Digunakan</h2>
            <div class="flex flex-wrap justify-center gap-6">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-red-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">L</span>
                    </div>
                    <span class="text-gray-700 font-medium">Laravel 12</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-indigo-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-xs">TW</span>
                    </div>
                    <span class="text-gray-700 font-medium">Tailwind CSS</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">V</span>
                    </div>
                    <span class="text-gray-700 font-medium">Vite</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-orange-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-xs">B</span>
                    </div>
                    <span class="text-gray-700 font-medium">Blade</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-purple-500 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-xs">M</span>
                    </div>
                    <span class="text-gray-700 font-medium">MySQL</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection