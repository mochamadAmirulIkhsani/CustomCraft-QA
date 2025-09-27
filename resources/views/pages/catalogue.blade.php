@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')

{{-- Hero Section --}}
<section class="relative py-20 bg-gradient-to-br from-maroon-600 via-maroon-500 to-red-500 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Katalog <span class="text-yellow-400">Produk</span>
        </h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-8">
            Temukan berbagai pilihan produk percetakan berkualitas tinggi untuk segala kebutuhan bisnis dan personal Anda
        </p>
        
        {{-- Search Bar --}}
        <div class="max-w-2xl mx-auto">
            <form action="{{ route('catalogue') }}" method="GET" class="relative">
                <input type="search" 
                       name="q" 
                       value="{{ request('q') }}"
                       placeholder="Cari produk yang Anda butuhkan..." 
                       class="w-full px-6 py-4 pl-12 pr-20 text-gray-900 bg-white rounded-full border-0 focus:ring-4 focus:ring-white/20 focus:outline-none text-lg">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <i class="fas fa-search text-gray-400 text-xl"></i>
                </div>
                <button type="submit" 
                        class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <span class="bg-maroon-500 hover:bg-maroon-600 text-white px-6 py-2 rounded-full font-semibold transition-colors duration-200">
                        Cari
                    </span>
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Breadcrumb & Filter --}}
<section class="bg-gray-50 py-6 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            {{-- Breadcrumb --}}
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-maroon-600">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Produk</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            {{-- Results count --}}
            <div class="text-sm text-gray-600">
                @if(request('q'))
                    Hasil pencarian untuk "<strong>{{ request('q') }}</strong>" - 
                @endif
                Menampilkan {{ $products->count() }} produk
            </div>
        </div>
    </div>
</section>

{{-- Products Grid --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if ($products->isEmpty())
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                    <i class="fas fa-search text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                    @if(request('q'))
                        Tidak ada produk yang ditemukan
                    @else
                        Belum ada produk tersedia
                    @endif
                </h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    @if(request('q'))
                        Coba ubah kata kunci pencarian atau lihat semua produk kami
                    @else
                        Saat ini belum ada produk yang tersedia. Silakan kembali lagi nanti.
                    @endif
                </p>
                @if(request('q'))
                    <a href="{{ route('catalogue') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-maroon-500 rounded-lg hover:bg-maroon-600 transition-colors duration-200">
                        <i class="fas fa-th-large mr-2"></i>
                        Lihat Semua Produk
                    </a>
                @endif
            </div>
        @else
            {{-- Products Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <a href="{{ route('product.detail', $product) }}" class="group block">
                        <div class="card card-hover overflow-hidden h-full">
                            {{-- Product Image --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->nama_produk }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                {{-- Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                {{-- Quick View Button --}}
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <span class="bg-white/90 backdrop-blur-sm text-maroon-600 px-6 py-2 rounded-full font-semibold text-sm shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat Detail
                                    </span>
                                </div>
                            </div>
                            
                            {{-- Product Info --}}
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors duration-200">
                                    {{ $product->nama_produk }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    {{ Str::limit(strip_tags($product->deskripsi), 100) }}
                                </p>
                                
                                {{-- Action Button --}}
                                <div class="flex items-center justify-between">
                                    <span class="text-maroon-500 font-semibold text-sm group-hover:text-maroon-600 transition-colors duration-200">
                                        Pelajari Lebih Lanjut
                                    </span>
                                    <i class="fas fa-arrow-right text-maroon-500 group-hover:text-maroon-600 group-hover:translate-x-1 transition-all duration-200"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
            Tidak Menemukan Yang Anda Cari?
        </h2>
        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
            Kami juga menerima pesanan custom sesuai kebutuhan spesifik Anda. 
            Hubungi tim kami untuk konsultasi gratis!
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/6287765748275" target="_blank"
               class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i class="fab fa-whatsapp mr-2"></i>
                Chat WhatsApp
            </a>
            <a href="{{ route('contact.create') }}" 
               class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-maroon-600 bg-white border-2 border-maroon-600 rounded-lg hover:bg-maroon-600 hover:text-white transition-colors duration-200">
                <i class="fas fa-envelope mr-2"></i>
                Kirim Pesan
            </a>
        </div>
    </div>
</section>

{{-- Features Section --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Mengapa Memilih CustomCraft?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Komitmen kami untuk memberikan yang terbaik dalam setiap produk
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-medal text-2xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Kualitas Premium</h3>
                <p class="text-gray-600">Menggunakan bahan terbaik dan teknologi printing terdepan</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-shipping-fast text-2xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pengerjaan Cepat</h3>
                <p class="text-gray-600">Proses produksi yang efisien dengan hasil yang memuaskan</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-headset text-2xl text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Layanan 24/7</h3>
                <p class="text-gray-600">Tim customer service siap membantu kapan saja Anda butuhkan</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
