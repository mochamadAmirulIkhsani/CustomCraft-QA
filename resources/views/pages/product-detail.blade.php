@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->nama_produk)

@section('content')
    <div class="container my-5">
        <div class="row">
            {{-- Kolom Gambar --}}
            <div class="col-md-6">
                <div class="main-image-wrapper mb-3"
                    style="position: relative; width: 100%; aspect-ratio: 4/3; overflow: hidden;">

                    <img id="mainProductImage" src="{{ asset('storage/' . $product->image) }}"
                        class="img-fluid rounded shadow main-image" alt="Gambar utama {{ $product->nama_produk }}"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: opacity 0.4s ease-in-out;">
                </div>

                <div class="row g-2">
                    {{-- Thumbnail utama --}}
                    <div class="col-3">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            data-src="{{ asset('storage/' . $product->image) }}"
                            class="img-fluid rounded shadow thumbnail-image active"
                            alt="Gambar utama {{ $product->nama_produk }}">
                    </div>

                    {{-- Thumbnail tambahan --}}
                    @if ($product->image2)
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $product->image2) }}"
                                data-src="{{ asset('storage/' . $product->image2) }}"
                                class="img-fluid rounded shadow thumbnail-image" alt="Gambar 2">
                        </div>
                    @endif
                    @if ($product->image3)
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $product->image3) }}"
                                data-src="{{ asset('storage/' . $product->image3) }}"
                                class="img-fluid rounded shadow thumbnail-image" alt="Gambar 3">
                        </div>
                    @endif
                    @if ($product->image4)
                        <div class="col-3">
                            <img src="{{ asset('storage/' . $product->image4) }}"
                                data-src="{{ asset('storage/' . $product->image4) }}"
                                class="img-fluid rounded shadow thumbnail-image" alt="Gambar 4">
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kolom Deskripsi --}}
            <div class="col-md-6">
                <h1 class="fw-bold">{{ $product->nama_produk }}</h1>
                <hr>
                <h5 class="text-muted">Deskripsi Produk</h5>
                <div class="product-description">
                    {!! $product->deskripsi !!}
                </div>

                <div class="d-grid gap-2 mt-4">
                    @if (!empty($product->no_whatsapp) && !empty($product->nama_produk))
                        @php
                            $whatsappText = 'Halo Admin, saya tertarik dengan produk *' . $product->nama_produk . '*';
                        @endphp

                        <a href="https://wa.me/send?phone=62{{ $product->no_whatsapp }}&text={{ urlencode($whatsappText) }}"
                            target="_blank" class="btn btn-success btn-lg">
                            <i class="bi bi-whatsapp"></i> Hubungi via WhatsApp (+62{{ $product->no_whatsapp }})
                        </a>
                    @else
                        <button class="btn btn-success btn-lg" disabled>
                            <i class="bi bi-whatsapp"></i> Nomor WhatsApp Tidak Tersedia
                        </button>
                    @endif

                    <a href="{{ route('catalogue') }}" class="btn btn-secondary mt-2">
                        Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .thumbnail-image {
            cursor: pointer;
            transition: transform 0.2s, opacity 0.2s;
            opacity: 0.9;
        }

        .thumbnail-image:hover {
            transform: scale(1.05);
            opacity: 1;
        }

        .thumbnail-image.active {
            border: 2px solid #28a745;
            opacity: 1;
        }

        .main-image-wrapper {
            position: relative;
            width: 100%; /* disesuaikan agar gambar penuh */
            aspect-ratio: 4/3;
            overflow: hidden;
            height: auto; /* biarkan otomatis sesuai aspek rasio */
        }

        .main-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.4s ease-in-out;
            opacity: 1;
        }

        .main-image.fade-out {
            opacity: 0;
        }

        /* Styling tulisan di atas gambar */
        .main-image-caption {
            position: absolute;
            bottom: 10px;
            left: 10px;
            padding: 8px 15px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 5px;
            z-index: 10; /* agar selalu di atas gambar */
            pointer-events: none; /* agar tidak mengganggu klik */
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImage = document.getElementById('mainProductImage');
            const thumbnails = document.querySelectorAll('.thumbnail-image');

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function () {
                    const newSrc = this.getAttribute('data-src');
                    const newAlt = this.alt;

                    if (mainImage.src === newSrc) return;

                    // Fade out dulu
                    mainImage.classList.add('fade-out');

                    // Setelah fade out selesai, ganti gambar dan fade in
                    setTimeout(() => {
                        mainImage.src = newSrc;
                        mainImage.alt = newAlt;
                        mainImage.classList.remove('fade-out');
                    }, 400); // durasi sama dengan CSS transition

                    // Update border aktif thumbnail
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endpush
