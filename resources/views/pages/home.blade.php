@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')

{{-- Bagian 1: Carousel Dinamis dengan Struktur Baru --}}
@if($banners->isNotEmpty())
{{-- Bagian Carousel Imersif --}}
<div id="immersiveCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

    {{-- 1. INDIKATOR KUSTOM (GARIS) --}}
    <div class="carousel-indicators carousel-indicators-lines">
        @foreach($banners as $banner)
            <button type="button"
                    data-bs-target="#immersiveCarousel"
                    data-bs-slide-to="{{ $loop->index }}"
                    class="{{ $loop->first ? 'active' : '' }}"
                    aria-current="{{ $loop->first ? 'true' : 'false' }}"
                    aria-label="Slide {{ $loop->iteration }}">
            </button>
        @endforeach
    </div>

    {{-- 2. KONTEN CAROUSEL (INNER) --}}
    <div class="carousel-inner">
        @foreach($banners as $banner)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                {{-- Gambar akan bertindak sebagai background --}}
                <img src="{{ asset('storage/' . $banner->image_path) }}"
                     class="d-block w-100"
                     alt="{{ $banner->title }}">

                {{-- Overlay Gelap untuk Keterbacaan Teks --}}
                <div class="carousel-overlay"></div>

                {{-- Caption (Teks dan Tombol) yang Terpusat --}}
                <div class="carousel-caption text-center">
                    {{-- Judul dengan animasi fade-in --}}
                    <h1>{{ $banner->title }}</h1>

                    {{-- Deskripsi (opsional, tampilkan jika ada) --}}
                    @if(isset($banner->description) && !empty($banner->description))
                        <p>{{ $banner->description }}</p>
                    @endif

                    {{-- Tombol Call-to-Action dengan animasi --}}
                    <a href="{{ route('catalogue') }}" class="btn btn-outline-light btn-lg mt-3">
                        Jelajahi Sekarang
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 3. KONTROL KIRI/KANAN (OPSIONAL, tapi direkomendasikan) --}}
    <button class="carousel-control-prev" type="button" data-bs-target="#immersiveCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#immersiveCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif

{{-- Bagian 2: Fitur Utama (Best Quality, etc) --}}
<div class="py-3 bg-maroon text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-box mx-auto">
                    <div class="feature-icon">
                        <img src="{{ asset('images/icon/thumbs-up.svg') }}" class="feature-icon" alt="Best Quality Icon">
                    </div>
                    <div class="feature-text text-start">
                        <h6>Best Quality</h6>
                        <p>Kami selalu menggunakan bahan terbaik untuk semua produk</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box mx-auto">
                    <div class="feature-icon">
                        <img src="{{ asset('images/icon/professional.svg') }}" class="feature-icon" alt="Professional Icon">
                    </div>
                    <div class="feature-text text-start">
                        <h6>Professional</h6>
                        <p>Dibuat dengan hati-hati dan presisi memastikan bahwa produk menjadi hasil final yang baik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-box mx-auto">
                    <div class="feature-icon">
                        <img src="{{ asset('images/icon/price.svg') }}" class="feature-icon" alt="Harga Icon">
                    </div>
                    <div class="feature-text text-start">
                        <h6>Harga</h6>
                        <p>Kami memberikan harga yang terjangkau tanpa mengorbankan kualitas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bagian 3: Why Choose Us --}}
<div class="py-3">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="{{ asset('images/thumbsup.png') }}" alt="thumbs-up" class="img-fluid rounded">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-3">Mengapa <br />Menggunakan Jasa Kami ?</h2>
                <p class="mb-4">
                    Berusaha menciptakan setiap cetakan dengan kualitas unggul tanpa kompromi demi memastikan kepuasan pelanggan yang tinggi, sekaligus terus menerapkan inovasi dalam proses produksi untuk meningkatkan efisiensi, ketepatan, dan kecepatan dalam menghasilkan produk berkualitas.
                    <br><br>
                    Selain itu, memastikan setiap cetakan memiliki keunggulan yang membedakan, baik dari segi desain, keakuratan, maupun keandalan, sehingga mampu memperkuat reputasi dan citra merek.
                </p>

                {{-- Mengganti v-for dengan @foreach --}}
                @foreach($features as $item)
                <div class="d-flex mb-4 align-items-start">
                    <div class=" rounded text-white me-3 d-flex justify-content-center align-items-center">
                        <img src="{{ asset($item['icon']) }}" alt="feature icon" class="img-fluid" style="width: 100%; height: 100%">
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">{{ $item['title'] }}</h6>
                        <p class="mb-0 small">{{ $item['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Bagian 4: Our Service / Galeri Produk --}}
<div class="container py-5 text-center">
    <p class="text-uppercase fw-bold small">Our Service</p>
    <h2 class="fw-bold">Ayo Wujudkan Desain Idemu!</h2>

    <div class="row mt-4">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <a href="{{ route('product.detail', $product) }}" class="text-decoration-none">
                <div class="position-relative service-item">
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->nama_produk }}"
                        {{-- TAMBAHKAN CLASS BARU 'service-item-image' --}}
                        class="img-fluid rounded shadow service-item-image">

                    <div class="position-absolute top-50 start-50 translate-middle text-white fw-bold fs-5" style="text-shadow: 1px 1px 4px black;">
                        {{ strtoupper($product->nama_produk) }}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div>
        <a href="{{ route('catalogue') }}" class="btn btn-secondary mt-4">
            Produk Lainnya
        </a>
    </div>
</div>

{{-- Bagian 5: Testimoni Pelanggan --}}
<div class="container py-5">
    <h2 class="text-center fw-bold mb-5 text-uppercase" style="letter-spacing: 2px;">
      What Our Customers Say
    </h2>
    <div class="row g-4">
        {{-- Mengganti v-for dengan @foreach --}}
        @foreach($reviews as $review)
        <div class="col-md-6 col-lg-6">
            <div class="card review-card h-100 border-0 shadow-sm bg-light">
                <div class="position-relative">
                    <img src="{{ asset($review['image']) }}" class="card-img-top rounded-top review-image" alt="Customer Review">
                    <div class="overlay-gradient rounded-top"></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('styles')
<style>
    .bg-maroon {
        background-color: #8b1c1c;
    }
    .feature-box {
        border-radius: 10px;
        padding: 20px;
        display: inline-flex;
        align-items: center;
        width: 100%;
        max-width: 350px; /* Optional: to keep them from stretching too much */
        height: 100px;
    }
    .feature-icon {
        width: 40px;
        height: 40px;
        margin-right: 15px;
    }
    .feature-text h6 {
        margin: 0;
        font-weight: bold;
        color: rgb(255, 255, 255);
    }
    .feature-text p {
        margin: 0;
        font-size: 12px;
        color: rgb(255, 255, 255);
    }
    .icon-box {
        width: 50px;
        height: 50px;
        flex-shrink: 0; /* Mencegah ikon menyusut */
        padding: 10px;
    }
    .review-card {
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .review-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
    .review-image {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .review-card:hover .review-image {
        transform: scale(1.05);
    }
    .overlay-gradient {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), transparent 70%);
    }
    .service-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;

        /* BERI TINGGI YANG TETAP UNTUK WADAH */
        height: 250px; /* Anda bisa sesuaikan tingginya */
    }

    /* CSS BARU UNTUK GAMBAR */
    .service-item-image {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ini adalah kuncinya! "Zoom" gambar tanpa distorsi */
        transition: transform 0.3s ease;
    }

    .service-item:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Efek hover zoom sekarang diterapkan ke gambar, bukan ke wadahnya */
    .service-item:hover .service-item-image {
        transform: scale(1.1);
    }

    /* --- Gaya Carousel Modern --- */
    .hero-carousel-container {
        /* Menghilangkan padding dari container bootstrap */
        margin-left: calc(-1 * var(--bs-gutter-x) * 0.5);
        margin-right: calc(-1 * var(--bs-gutter-x) * 0.5);
    }

    .hero-slide {
        height: 80vh; /* Tinggi carousel setinggi 80% layar */
        min-height: 500px;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Overlay gelap */
        z-index: 1;
    }

    .hero-caption {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
    }

    /* --- Indikator Kustom --- */
    .custom-indicators {
        bottom: 30px;
    }
    .custom-indicators [data-bs-target] {
        width: 30px; /* Lebar setiap indikator */
        height: 4px; /* Tinggi indikator, membuatnya jadi garis */
        margin: 0 5px;
        border-radius: 0; /* Menghilangkan bentuk bulat */
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        opacity: 0.7;
        transition: opacity 0.6s ease;
    }

    .custom-indicators .active {
        opacity: 1;
        background-color: white;
    }

    /* --- Animasi Tombol di Caption --- */
    .hero-caption .btn {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hero-caption .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* 1. Pengaturan Utama Carousel */
    #immersiveCarousel {
        /* Tinggi imersif, 80% dari tinggi layar */
        height: 80vh;
        width: 100%;
        /* Pastikan tidak ada margin atas bawaan dari container lain */
        margin-top: 0;
    }

    #immersiveCarousel .carousel-inner,
    #immersiveCarousel .carousel-item {
        height: 100%;
    }

    #immersiveCarousel .carousel-item img {
        /* Memastikan gambar menutupi area tanpa distorsi */
        object-fit: cover;
        width: 100%;
        height: 100%;
        /* Filter halus untuk efek sinematik */
        filter: brightness(0.9);
    }

    /* 2. Overlay Gelap */
    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* Gradient dari hitam semi-transparan ke lebih transparan di atas */
        background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.2) 100%);
    }

    /* 3. Penataan Caption (Teks & Tombol) */
    #immersiveCarousel .carousel-caption {
        /* Override posisi default Bootstrap */
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 2rem;
        /* Pusatkan konten secara vertikal dan horizontal */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 10;
    }

    #immersiveCarousel .carousel-caption h1 {
        font-size: clamp(2rem, 5vw, 4rem); /* Ukuran font responsif */
        font-weight: 700;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }

    #immersiveCarousel .carousel-caption p {
        font-size: clamp(1rem, 2vw, 1.25rem);
        max-width: 700px; /* Batasi lebar paragraf agar mudah dibaca */
        margin-top: 1rem;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    }

    /* 4. Tombol Call-to-Action Kustom */
    #immersiveCarousel .btn-outline-light {
        border-width: 2px;
        border-radius: 50px; /* Tombol pil yang modern */
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    #immersiveCarousel .btn-outline-light:hover {
        background-color: #fff;
        color: #000;
        transform: scale(1.05); /* Efek zoom kecil saat hover */
    }

    /* 5. Indikator Garis Kustom */
    .carousel-indicators-lines {
        bottom: 30px; /* Posisikan lebih tinggi dari bawah */
        z-index: 15;
    }

    .carousel-indicators-lines button {
        width: 50px; /* Lebar setiap garis */
        height: 4px; /* Tinggi setiap garis */
        margin: 0 5px;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        opacity: 0.7;
        transition: opacity 0.4s ease;
    }

    .carousel-indicators-lines button.active {
        opacity: 1;
        background-color: #ffffff;
    }

    /* 6. Animasi Teks */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Terapkan animasi hanya pada item yang aktif */
    #immersiveCarousel .carousel-item.active .carousel-caption h1 {
        animation: fadeInDown 0.8s ease-out forwards;
    }

    #immersiveCarousel .carousel-item.active .carousel-caption p,
    #immersiveCarousel .carousel-item.active .carousel-caption .btn {
        animation: fadeInUp 0.8s ease-out 0.3s forwards; /* Delay 0.3s */
        opacity: 0; /* Mulai dari tidak terlihat */
    }

</style>
@endpush
