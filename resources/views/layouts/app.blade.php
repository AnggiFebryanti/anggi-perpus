<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Perpustakaan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav id="main-navbar" class="fixed top-0 left-0 right-0 bg-blue-600 shadow-lg z-50 transition-shadow duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo / Brand -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <span class="text-white font-bold text-xl">Perpustakaan</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="flex items-center space-x-4">
                    @guest
                        <!-- Menu untuk Tamu (Guest) -->
                        <a href="{{ route('login') }}"
                            class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                            Login
                        </a>
                    @else
                        <!-- Menu untuk User yang sudah Login -->
                        <a href="{{ route('dashboard') }}"
                            class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                            Dashboard
                        </a>
                        <span class="text-blue-200">|</span>
                        <a href="{{ route('books.index') }}"
                            class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                            Buku
                        </a>
                        <span class="text-blue-200">|</span>
                        <a href="{{ route('categories.index') }}"
                            class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                            Kategori
                        </a>
                        <span class="text-blue-200">|</span>
                        <a href="{{ route('loans.index') }}"
                            class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                            Peminjaman
                        </a>
                        <span class="text-blue-200">|</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-white hover:text-red-200 px-3 py-2 rounded-md text-sm font-medium transition duration-150 cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden">
                    <button type="button" class="text-white hover:text-blue-200 focus:outline-none"
                        onclick="toggleMobileMenu()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden sm:hidden bg-blue-700">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @guest
                    <a href="{{ route('login') }}"
                        class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                        Login
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('books.index') }}"
                        class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                        Buku
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                        Kategori
                    </a>
                    <a href="{{ route('loans.index') }}"
                        class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                        Peminjaman
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-white hover:bg-blue-800 w-full text-left block px-3 py-2 rounded-md text-base font-medium">
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Flash Messages (Toast Notifications) -->
    @if (session('success'))
        <div id="toast-success"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-green-50 border border-green-200 rounded-md shadow-lg p-4 transition-all duration-300 transform translate-x-full">
            <div class="flex">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
                <div class="shrink-0 ml-4">
                    <button onclick="closeToast('toast-success')" class="text-green-400 hover:text-green-600">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div id="toast-error"
            class="fixed top-4 right-4 z-50 max-w-sm w-full bg-red-50 border border-red-200 rounded-md shadow-lg p-4 transition-all duration-300 transform translate-x-full">
            <div class="flex">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </p>
                </div>
                <div class="shrink-0 ml-4">
                    <button onclick="closeToast('toast-error')" class="text-red-400 hover:text-red-600">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="grow pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-sm">
                    &copy; {{ date('Y') }} Sistem Perpustakaan. Dibuat dengan Laravel & Tailwind CSS.
                </p>
            </div>
        </div>
    </footer>

    <!-- Script untuk Mobile Menu & Toasts -->
    <style>
        .shadow-scroll {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.15);
        }
    </style>
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function closeToast(id) {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }
        }

        // Auto-dismiss toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = ['toast-success', 'toast-error'];
            toasts.forEach(id => {
                const toast = document.getElementById(id);
                if (toast) {
                    // Show toast with slide-in animation
                    setTimeout(() => {
                        toast.classList.remove('translate-x-full');
                    }, 100);

                    // Auto-dismiss after 5 seconds
                    setTimeout(() => {
                        closeToast(id);
                    }, 5000);
                }
            });

            // Add shadow to navbar on scroll
            const navbar = document.getElementById('main-navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 0) {
                    navbar.classList.add('shadow-scroll');
                } else {
                    navbar.classList.remove('shadow-scroll');
                }
            });
        });
    </script>
</body>

</html>
