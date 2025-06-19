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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Tambahkan Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Tambahkan baris ini untuk Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Styles -->
    <style>
        /* Navbar background */
        .custom-navbar {
            background-color: #94171d !important;
        }

        /* Logo bulat + shadow + hover glow */
        .logo-style {
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        /* Glow merah saat hover */
        .logo-style:hover {
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.7), 0 4px 10px rgba(0, 0, 0, 0.4);
            transform: scale(1.05);
        }

        /* Nav Link Active State */
        .navbar-nav .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid #ffd1d1;
        }

        /* Hover effect nav-link */
        .navbar-nav .nav-link {
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd1d1 !important;
            /* Use !important to override Bootstrap's default hover */
            transform: translateY(-2px);
        }

        /* Hover tombol search */
        .btn-light:hover {
            background-color: #c82333;
            color: white;
        }

        footer {
            font-size: 14px;
            background-color: #94171d;
        }

        /* Ensure footer stays at the bottom */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .footer-logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            /* Hapus border atau sesuaikan warnanya agar cocok dengan background footer */
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: transform 0.3s ease;
        }

        .footer-logo:hover {
            transform: scale(1.1);
        }
    </style>

    @stack('styles')
    @stack('scripts')

</head>

<body class="antialiased">

    <nav class="navbar sticky-top navbar-expand-lg custom-navbar navbar-dark">
        <div class="container-fluid">
            {{-- Mengganti <router-link> dengan tag <a> dan helper route() --}}
            <a href="{{ route('home') }}" class="navbar-brand">
                <img {{-- Ganti path gambar dengan helper asset() Laravel --}} src="{{ asset('images/logo.png') }}" alt="Custom Craft" width="65"
                    height="65" class="logo-style" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        {{-- Menambahkan class 'active' secara dinamis --}}
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            aria-current="page">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('catalogue') }}"
                            class="nav-link {{ request()->routeIs('catalogue') ? 'active' : '' }}"
                            aria-current="page">PRODUCT</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('aboutus') }}"
                            class="nav-link {{ request()->routeIs('aboutus') ? 'active' : '' }}">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        {{-- UBAH MENJADI 'contact.form' --}}
                        <a href="{{ route('contact.create') }}"
                            class="nav-link {{ request()->routeIs('contact.create') ? 'active' : '' }}">CONTACT US</a>
                    </li>
                </ul>
                <form class="d-flex ms-3" role="search" action="{{ route('catalogue') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Search"
                        aria-label="Search" />
                    <button class="btn btn-light" type="submit">SEARCH</button>
                </form>
            </div>
        </div>
    </nav>

    <main>
        {{-- Mengganti <router-view> dengan @yield('content') --}}
        @yield('content')
    </main>

    <footer class="text-white py-5 mt-auto">
        <div class="container text-center">

            <!-- Logo dan Nama Perusahaan -->
            <a href="{{ url('/') }}" class="d-inline-block mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Custom Craft Logo" class="footer-logo">
            </a>
            <h5 class="fw-bold">Custom Craft</h5>
            <p class="text-white-50 mb-4">We Help You Create Unique Products</p>

            <!-- Menu Navigasi -->
            <div class="d-flex justify-content-center gap-3 gap-md-4 mb-4">
                <a href="{{ route('aboutus') }}" class="text-white text-decoration-none">About Us</a>
                <a href="{{ route('catalogue') }}" class="text-white text-decoration-none">Products</a>
                <a href="{{ route('contact.create') }}" class="text-white text-decoration-none">Contact</a>
                <a href="{{ url('/admin') }}" class="text-white text-decoration-none">Admin</a>
            </div>

            <!-- Ikon Kontak & Sosial Media -->
            <div id="contact" class="d-flex justify-content-center gap-4 mb-4">
                <a href="https://www.instagram.com" target="_blank" class="text-white fs-4" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="mailto:Customcraftmlg@Gmail.Com" class="text-white fs-4" title="Email">
                    <i class="fas fa-envelope"></i>
                </a>
                <a href="https://wa.me/6287765748275" target="_blank" class="text-white fs-4" title="WhatsApp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>

            <!-- Copyright -->
            <div class="border-top border-white-50 pt-4 mt-4">
                <small class="text-white-50">
                    © {{ date('Y') }} Custom Craft. All Rights Reserved. <br>
                    Jl. Pisang Kipas No.10a, Kota Malang
                </small>
            </div>

        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
