    @extends('layouts.app')

    @section('title', 'Tentang Kami')

    @section('content')
    <div class="container my-5 py-5">
        <div class="row justify-content-center align-items-center gy-5">

            <!-- Kolom Kiri: Logo Besar dan Rating -->
            <div class="col-md-3 text-center">
                <div class="text-white shadow-lg rounded-4">
                    {{-- Mengganti path gambar dengan helper asset() --}}
                    <img
                        src="{{ asset('images/logo1.png') }}"
                        alt="Custom Craft"
                        class="img-fluid mb-3"
                        style="width: 100%"
                    />
                    <h5 class="fw-bold">Custom Craft</h5>
                </div>
                <div class="mt-4">
                    <p class="mb-2 text-muted fw-semibold">Best Ratings</p>
                    <div class="fs-4">😍 😃 😊 😁 😄</div>
                </div>
            </div>

            <!-- Kolom Tengah: Info Penjualan dan Logo Kecil -->
            <div class="col-md-3 text-center">
                <div class="rounded-4 shadow-lg mb-3">
                    {{-- Mengganti path gambar dengan helper asset() --}}
                    <img
                        src="{{ asset('images/logo1.png') }}"
                        alt="Custom Craft Small"
                        class="img-fluid mb-2"
                        style="width: 100%"
                    />
                    <h6 class="fw-bold m-0">Custom Craft</h6>
                </div>
                <div class="bg-white p-3 rounded-4 shadow text-start">
                    <h6 class="fw-bold text-dark mb-1">30,000+</h6>
                    <p class="small text-muted mb-2">
                        Sales in July 2021 with 5-star ratings and happy clients.
                    </p>
                    <div class="d-flex flex-wrap gap-2">
                        <span>👤</span><span>👤</span><span>👤</span><span>👤</span>
                        <span>👤</span><span>👤</span><span>👤</span><span>👤</span>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Tentang Kami -->
            <div class="col-md-5">
                <small class="text-uppercase text-danger fw-semibold letter-spacing">A BIT</small>
                <h2 class="fw-bold mb-3">ABOUT US</h2>
                <p class="text-muted lh-lg">
                    Custom Craft adalah rumah bagi para pengrajin kreatif yang mencintai
                    keunikan dan sentuhan personal dalam setiap karya. Kami percaya bahwa
                    setiap produk buatan tangan memiliki cerita dan jiwa di baliknya.
                </p>

                {{-- Mengganti <router-link> dengan tag <a> dan helper route() --}}
                <a
                    href="{{ route('catalogue') }}"
                    class="btn px-4 py-2 mt-3 shadow-sm explore-btn"
                >
                    EXPLORE MORE
                </a>
            </div>
        </div>
    </div>
    @endsection

@push('styles')
<style>
    /* CSS dari <style scoped> dipindahkan ke sini */
    .about-section img { /* Menambahkan class agar lebih spesifik */
        border-radius: 16px;
        background-color: #fff;
        padding: 8px;
    }

    .letter-spacing {
        letter-spacing: 2px;
    }

    .explore-btn {
        background-color: #94171d;
        transition: 0.3s ease-in-out;
        border-radius: 12px;
        color: white;
    }

    .explore-btn:hover {
        background-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15) !important; /* Tambahkan !important jika perlu */
    }
</style>
@endpush
