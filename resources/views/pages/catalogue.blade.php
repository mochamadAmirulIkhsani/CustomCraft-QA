@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
    <div class="container my-5">
        <div class="text-center mb-5">
            <h2 class="fw-bolder">Produk Kami</h2>
            <p class="text-muted">Temukan berbagai pilihan produk kustom berkualitas tinggi untuk segala kebutuhan Anda.</p>
        </div>

        @if ($products->isEmpty())
            <p class="lead text-center">Saat ini belum ada produk yang tersedia.</p>
        @else
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">

                @foreach ($products as $product)
                    {{-- Kita bungkus semuanya dengan tag <a> --}}
                    <a href="{{ route('product.detail', $product) }}" class="col text-decoration-none product-card-link">
                        <div class="card product-card h-100">

                            {{-- Wadah untuk gambar agar efek zoom tidak keluar dari kartu --}}
                            <div class="product-card-img-container">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                    alt="Gambar {{ $product->nama_produk }}" />
                            </div>

                            {{-- Lapisan overlay yang muncul saat hover --}}
                            <div class="product-card-overlay">
                                <span class="btn btn-light btn-sm">Lihat Detail</span>
                            </div>

                            <div class="card-body">
                                <h6 class="card-title text-center">{{ $product->nama_produk }}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        /* Mengatur link agar tidak memiliki efek aneh saat hover */
        .product-card-link {
            color: inherit;
            /* Mewarisi warna teks dari parent */
            transition: color 0.3s ease;
        }

        .product-card-link:hover {
            color: inherit;
        }

        /* Gaya utama untuk kartu produk modern */
        .product-card {
            border: none;
            /* Menghilangkan border default bootstrap */
            border-radius: 12px;
            /* Membuat sudut lebih bulat dan modern */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            /* Bayangan yang sangat lembut */
            transition: all 0.4s ease-in-out;
            position: relative;
            /* Diperlukan untuk memposisikan overlay */
        }

        /* Wadah gambar untuk efek zoom */
        .product-card-img-container {
            height: 250px;
            /* Tinggi tetap untuk semua gambar */
            overflow: hidden;
            /* KUNCI: Menyembunyikan bagian gambar yang 'zoom' keluar */
            border-radius: 12px 12px 0 0;
            /* Menyesuaikan sudut atas */
        }

        .product-card .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Kunci untuk gambar responsif yang seragam */
            transition: transform 0.4s ease-in-out;
        }

        /* Gaya untuk lapisan overlay */
        .product-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 250px;
            /* Sama dengan tinggi wadah gambar */
            background-color: rgba(0, 0, 0, 0.4);
            /* Warna hitam semi-transparan */
            border-radius: 12px 12px 0 0;

            /* Pusatkan konten di dalam overlay (tombol) */
            display: flex;
            justify-content: center;
            align-items: center;

            opacity: 0;
            /* Sembunyikan secara default */
            transition: opacity 0.4s ease-in-out;
        }

        .product-card .card-title {
            font-weight: 600;
            /* Sedikit lebih tebal dari normal */
            color: #333;
        }

        /* --- EFEK HOVER --- */

        /* Saat mouse diarahkan ke link kartu */
        .product-card-link:hover .product-card {
            transform: translateY(-8px);
            /* Angkat kartu sedikit */
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            /* Bayangan menjadi lebih jelas */
        }

        .product-card-link:hover .card-img-top {
            transform: scale(1.1);
            /* Efek zoom-in pada gambar */
        }

        .product-card-link:hover .product-card-overlay {
            opacity: 1;
            /* Tampilkan overlay saat hover */
        }
    </style>
@endpush
