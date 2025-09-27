<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custom Craft - @yield('title', 'Selamat Datang')</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.svg') }}">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles')
    @stack('scripts')

</head>

<body class="antialiased min-h-screen bg-gray-50">

    <nav class="sticky top-0 z-50 bg-maroon-500 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Custom Craft" 
                             class="h-12 w-12 rounded-full object-cover shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105" />
                        <span class="ml-3 text-xl font-bold text-white hidden sm:block">CustomCraft</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ route('home') }}" 
                           class="px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-white border-b-2 border-white' : 'text-gray-200 hover:text-white hover:border-b-2 hover:border-gray-200' }}">
                            Home
                        </a>
                        <a href="{{ route('catalogue') }}" 
                           class="px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('catalogue') ? 'text-white border-b-2 border-white' : 'text-gray-200 hover:text-white hover:border-b-2 hover:border-gray-200' }}">
                            Products
                        </a>
                        <a href="{{ route('aboutus') }}" 
                           class="px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('aboutus') ? 'text-white border-b-2 border-white' : 'text-gray-200 hover:text-white hover:border-b-2 hover:border-gray-200' }}">
                            About
                        </a>
                        <a href="{{ route('contact.create') }}" 
                           class="px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('contact.create') ? 'text-white border-b-2 border-white' : 'text-gray-200 hover:text-white hover:border-b-2 hover:border-gray-200' }}">
                            Contact
                        </a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="hidden md:block">
                    <form action="{{ route('catalogue') }}" method="GET" class="flex items-center">
                        <div class="relative">
                            <input type="search" name="q" placeholder="Search products..." 
                                   class="w-64 px-4 py-2 pl-10 pr-4 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-2 focus:ring-white focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-200 hover:text-white hover:bg-maroon-600 p-2 rounded-md">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-maroon-600">
                <a href="{{ route('home') }}" 
                   class="block px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'text-white bg-maroon-700' : 'text-gray-200 hover:text-white hover:bg-maroon-700' }} rounded-md">
                    Home
                </a>
                <a href="{{ route('catalogue') }}" 
                   class="block px-3 py-2 text-base font-medium {{ request()->routeIs('catalogue') ? 'text-white bg-maroon-700' : 'text-gray-200 hover:text-white hover:bg-maroon-700' }} rounded-md">
                    Products
                </a>
                <a href="{{ route('aboutus') }}" 
                   class="block px-3 py-2 text-base font-medium {{ request()->routeIs('aboutus') ? 'text-white bg-maroon-700' : 'text-gray-200 hover:text-white hover:bg-maroon-700' }} rounded-md">
                    About
                </a>
                <a href="{{ route('contact.create') }}" 
                   class="block px-3 py-2 text-base font-medium {{ request()->routeIs('contact.create') ? 'text-white bg-maroon-700' : 'text-gray-200 hover:text-white hover:bg-maroon-700' }} rounded-md">
                    Contact
                </a>
                <!-- Mobile Search -->
                <form action="{{ route('catalogue') }}" method="GET" class="px-3 py-2">
                    <input type="search" name="q" placeholder="Search products..." 
                           class="w-full px-3 py-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-md">
                </form>
            </div>
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-maroon-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <!-- Logo dan Nama Perusahaan -->
                <div class="mb-8">
                    <a href="{{ url('/') }}" class="inline-block">
                        <img src="{{ asset('images/logo.png') }}" alt="Custom Craft Logo" 
                             class="h-16 w-16 rounded-full object-cover shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 mb-4">
                    </a>
                    <h3 class="text-2xl font-bold text-white mb-2">CustomCraft</h3>
                    <p class="text-gray-200 text-lg">We Help You Create Unique Products</p>
                </div>

                <!-- Menu Navigasi -->
                <div class="flex justify-center items-center space-x-8 mb-8">
                    <a href="{{ route('aboutus') }}" 
                       class="text-gray-200 hover:text-white transition-colors duration-200 text-sm font-medium">
                        About Us
                    </a>
                    <a href="{{ route('catalogue') }}" 
                       class="text-gray-200 hover:text-white transition-colors duration-200 text-sm font-medium">
                        Products
                    </a>
                    <a href="{{ route('contact.create') }}" 
                       class="text-gray-200 hover:text-white transition-colors duration-200 text-sm font-medium">
                        Contact
                    </a>
                    <a href="{{ url('/admin') }}" 
                       class="text-gray-200 hover:text-white transition-colors duration-200 text-sm font-medium">
                        Admin
                    </a>
                </div>

                <!-- Ikon Kontak & Sosial Media -->
                <div class="flex justify-center items-center space-x-6 mb-8">
                    <a href="https://www.instagram.com" target="_blank" 
                       class="text-gray-200 hover:text-white transition-all duration-200 hover:scale-110" title="Instagram">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="mailto:Customcraftmlg@Gmail.Com" 
                       class="text-gray-200 hover:text-white transition-all duration-200 hover:scale-110" title="Email">
                        <i class="fas fa-envelope text-2xl"></i>
                    </a>
                    <a href="https://wa.me/6287765748275" target="_blank" 
                       class="text-gray-200 hover:text-white transition-all duration-200 hover:scale-110" title="WhatsApp">
                        <i class="fab fa-whatsapp text-2xl"></i>
                    </a>
                </div>

                <!-- Copyright -->
                <div class="pt-8 border-t border-gray-400">
                    <p class="text-gray-300 text-sm">
                        © {{ date('Y') }} CustomCraft. All Rights Reserved.
                    </p>
                    <p class="text-gray-400 text-xs mt-1">
                        Jl. Pisang Kipas No.10a, Kota Malang
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>
