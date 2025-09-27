@extends('layouts.app')

@section('title', 'Detail Produk - ' . $product->nama_produk)

@section('content')

{{-- Breadcrumb --}}
<section class="bg-gray-50 py-6 border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                        <a href="{{ route('catalogue') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-maroon-600 md:ml-2">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ Str::limit($product->nama_produk, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
</section>

{{-- Product Detail Section --}}
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            {{-- Product Images --}}
            <div class="space-y-6">
                {{-- Main Image --}}
                <div class="relative aspect-square bg-gray-100 rounded-2xl overflow-hidden shadow-lg">
                    <img id="mainProductImage" 
                         src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->nama_produk }}"
                         class="w-full h-full object-cover transition-opacity duration-500">
                    
                    {{-- Image Navigation --}}
                    @if($product->image2 || $product->image3 || $product->image4)
                        <div class="absolute top-4 right-4">
                            <div class="bg-black/50 text-white px-3 py-1 rounded-full text-sm">
                                <span id="currentImageIndex">1</span> / <span id="totalImages">{{ collect([$product->image, $product->image2, $product->image3, $product->image4])->filter()->count() }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                
                {{-- Thumbnail Gallery --}}
                <div class="grid grid-cols-4 gap-4">
                    <button class="thumbnail-btn aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-maroon-500 shadow-md" 
                            onclick="changeMainImage('{{ asset('storage/' . $product->image) }}', 1)">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="Thumbnail 1" 
                             class="w-full h-full object-cover">
                    </button>
                    
                    @if($product->image2)
                        <button class="thumbnail-btn aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-200 hover:border-maroon-400 transition-colors duration-200 shadow-md" 
                                onclick="changeMainImage('{{ asset('storage/' . $product->image2) }}', 2)">
                            <img src="{{ asset('storage/' . $product->image2) }}" 
                                 alt="Thumbnail 2" 
                                 class="w-full h-full object-cover">
                        </button>
                    @endif
                    
                    @if($product->image3)
                        <button class="thumbnail-btn aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-200 hover:border-maroon-400 transition-colors duration-200 shadow-md" 
                                onclick="changeMainImage('{{ asset('storage/' . $product->image3) }}', 3)">
                            <img src="{{ asset('storage/' . $product->image3) }}" 
                                 alt="Thumbnail 3" 
                                 class="w-full h-full object-cover">
                        </button>
                    @endif
                    
                    @if($product->image4)
                        <button class="thumbnail-btn aspect-square bg-gray-100 rounded-lg overflow-hidden border-2 border-gray-200 hover:border-maroon-400 transition-colors duration-200 shadow-md" 
                                onclick="changeMainImage('{{ asset('storage/' . $product->image4) }}', 4)">
                            <img src="{{ asset('storage/' . $product->image4) }}" 
                                 alt="Thumbnail 4" 
                                 class="w-full h-full object-cover">
                        </button>
                    @endif
                </div>
            </div>
            
            {{-- Product Information --}}
            <div class="space-y-8">
                {{-- Product Title & Badge --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-maroon-100 text-maroon-700 px-3 py-1 rounded-full text-sm font-semibold">
                            Produk Premium
                        </span>
                        <div class="flex items-center text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm"></i>
                            @endfor
                            <span class="ml-2 text-gray-600 text-sm">(4.9/5)</span>
                        </div>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        {{ $product->nama_produk }}
                    </h1>
                </div>
                
                {{-- Product Description --}}
                <div class="prose prose-lg max-w-none">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi Produk</h3>
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        {!! $product->deskripsi !!}
                    </div>
                </div>
                
                {{-- Product Features --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Kualitas Premium</h4>
                            <p class="text-sm text-gray-600">Material berkualitas tinggi</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Pengerjaan Cepat</h4>
                            <p class="text-sm text-gray-600">Proses produksi efisien</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-palette text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Design Custom</h4>
                            <p class="text-sm text-gray-600">Sesuai kebutuhan Anda</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-award text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Garansi Kualitas</h4>
                            <p class="text-sm text-gray-600">Jaminan hasil memuaskan</p>
                        </div>
                    </div>
                </div>
                
                {{-- Call to Action --}}
                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-maroon-50 to-red-50 p-6 rounded-2xl border border-maroon-200">
                        <h3 class="text-lg font-bold text-maroon-900 mb-2">Siap Memesan?</h3>
                        <p class="text-maroon-700 mb-4">Hubungi kami sekarang untuk konsultasi gratis dan penawaran terbaik!</p>
                        
                        <div class="flex flex-col sm:flex-row gap-3">
                            @if (!empty($product->no_whatsapp))
                                @php
                                    $whatsappText = 'Halo Admin CustomCraft! Saya tertarik dengan produk *' . $product->nama_produk . '*. Bisa bantu saya untuk informasi lebih lanjut?';
                                    $whatsappNumber = $product->no_whatsapp;
                                    // Remove leading zero if exists
                                    if (substr($whatsappNumber, 0, 1) === '0') {
                                        $whatsappNumber = '62' . substr($whatsappNumber, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappText) }}" 
                                   target="_blank"
                                   class="flex-1 inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fab fa-whatsapp mr-2 text-lg"></i>
                                    Chat WhatsApp
                                </a>
                            @else
                                <a href="https://wa.me/6287765748275?text={{ urlencode($whatsappText ?? 'Halo Admin CustomCraft!') }}" 
                                   target="_blank"
                                   class="flex-1 inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fab fa-whatsapp mr-2 text-lg"></i>
                                    Chat WhatsApp
                                </a>
                            @endif
                            
                            <a href="{{ route('contact.create') }}" 
                               class="flex-1 inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-maroon-600 bg-white border-2 border-maroon-600 rounded-lg hover:bg-maroon-600 hover:text-white transition-colors duration-200">
                                <i class="fas fa-envelope mr-2"></i>
                                Kirim Pesan
                            </a>
                        </div>
                    </div>
                    
                    {{-- Back to Catalogue --}}
                    <a href="{{ route('catalogue') }}" 
                       class="inline-flex items-center text-gray-600 hover:text-maroon-600 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Katalog
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Products Section --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Produk Lainnya</h2>
            <p class="text-lg text-gray-600">Lihat produk percetakan lainnya yang mungkin Anda butuhkan</p>
        </div>
        
        {{-- Simple grid showing other products --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($otherProducts as $otherProduct)
                <a href="{{ route('product.detail', $otherProduct) }}" class="group block">
                    <div class="card card-hover overflow-hidden">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $otherProduct->image) }}" 
                                 alt="{{ $otherProduct->nama_produk }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors duration-200">
                                {{ $otherProduct->nama_produk }}
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ Str::limit(strip_tags($otherProduct->deskripsi), 80) }}
                            </p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('catalogue') }}" 
               class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-maroon-600 bg-white border-2 border-maroon-600 rounded-lg hover:bg-maroon-600 hover:text-white transition-colors duration-200">
                <i class="fas fa-th-large mr-2"></i>
                Lihat Semua Produk
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    function changeMainImage(imageSrc, imageIndex) {
        const mainImage = document.getElementById('mainProductImage');
        const currentIndexSpan = document.getElementById('currentImageIndex');
        const thumbnailBtns = document.querySelectorAll('.thumbnail-btn');
        
        // Fade out effect
        mainImage.style.opacity = '0';
        
        setTimeout(() => {
            mainImage.src = imageSrc;
            mainImage.style.opacity = '1';
            
            // Update current image index
            if (currentIndexSpan) {
                currentIndexSpan.textContent = imageIndex;
            }
            
            // Update thumbnail borders
            thumbnailBtns.forEach((btn, index) => {
                if (index + 1 === imageIndex) {
                    btn.classList.remove('border-gray-200');
                    btn.classList.add('border-maroon-500');
                } else {
                    btn.classList.remove('border-maroon-500');
                    btn.classList.add('border-gray-200');
                }
            });
        }, 250);
    }
    
    // Optional: Keyboard navigation for images
    document.addEventListener('keydown', function(e) {
        const totalImages = parseInt(document.getElementById('totalImages')?.textContent || '1');
        const currentIndex = parseInt(document.getElementById('currentImageIndex')?.textContent || '1');
        
        if (e.key === 'ArrowLeft' && currentIndex > 1) {
            document.querySelectorAll('.thumbnail-btn')[currentIndex - 2].click();
        } else if (e.key === 'ArrowRight' && currentIndex < totalImages) {
            document.querySelectorAll('.thumbnail-btn')[currentIndex].click();
        }
    });
</script>
@endpush
