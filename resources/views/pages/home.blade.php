@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')

{{-- Hero Section --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    @if($banners->isNotEmpty())
        <!-- Background Slider -->
        <div class="absolute inset-0 z-0">
            @foreach($banners as $banner)
                <div class="absolute inset-0 transition-opacity duration-1000 {{ $loop->first ? 'opacity-100' : 'opacity-0' }}" 
                     data-slide="{{ $loop->index }}">
                    <img src="{{ asset('storage/' . $banner->image_path) }}" 
                         alt="{{ $banner->title }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-br from-black/70 via-black/50 to-transparent"></div>
                </div>
            @endforeach
        </div>
        
        <!-- Slide Indicators -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
            <div class="flex space-x-2">
                @foreach($banners as $banner)
                    <button class="w-12 h-1 bg-white/30 rounded-full transition-all duration-300 {{ $loop->first ? 'bg-white' : '' }}" 
                            data-slide-to="{{ $loop->index }}"></button>
                @endforeach
            </div>
        </div>
    @else
        <!-- Fallback gradient background -->
        <div class="absolute inset-0 bg-gradient-to-br from-maroon-600 via-maroon-500 to-red-500"></div>
    @endif
    
    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold mb-6 animate-fade-in-up">
            Wujudkan <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">Desain Impian</span> Anda
        </h1>
        <p class="text-lg sm:text-xl lg:text-2xl mb-8 text-gray-200 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s">
            Percetakan digital premium dengan kualitas terbaik dan harga terjangkau. 
            Dari kartu nama hingga banner besar, kami siap mewujudkan ide kreatif Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up" style="animation-delay: 0.4s">
            <a href="{{ route('catalogue') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-maroon-600 bg-white rounded-full hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-lg">
                <i class="fas fa-rocket mr-2"></i>
                Jelajahi Produk
            </a>
            <a href="{{ route('contact.create') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-maroon-600 transition-all duration-300 hover:scale-105">
                <i class="fas fa-phone mr-2"></i>
                Hubungi Kami
            </a>
        </div>
    </div>
    
    <!-- Scroll Down Arrow -->
    <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
        <i class="fas fa-chevron-down text-white text-2xl opacity-70"></i>
    </div>
</section>

{{-- Features Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">Mengapa Pilih Kami</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Keunggulan CustomCraft</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Komitmen kami terhadap kualitas dan kepuasan pelanggan menjadikan kami pilihan terbaik</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($features as $feature)
                <div class="group card card-hover p-8 text-center">
                    <div class="w-16 h-16 mx-auto mb-6 p-4 bg-gradient-to-br from-maroon-500 to-red-500 rounded-2xl shadow-lg group-hover:shadow-xl transition-all duration-300">
                        <img src="{{ asset($feature['icon']) }}" alt="{{ $feature['title'] }}" class="w-full h-full object-contain filter brightness-0 invert">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Services Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">Layanan Kami</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Ayo Wujudkan Desain Idemu!</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Berbagai layanan percetakan profesional untuk semua kebutuhan bisnis dan personal Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($products as $product)
                <a href="{{ route('product.detail', $product) }}" class="group block">
                    <div class="card card-hover overflow-hidden">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->nama_produk }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $product->nama_produk }}</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit(strip_tags($product->deskripsi), 120) }}</p>
                            <div class="mt-4 flex items-center text-maroon-500 font-semibold group-hover:text-maroon-600 transition-colors duration-200">
                                <span class="mr-2">Lihat Detail</span>
                                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <div class="text-center">
            <a href="{{ route('catalogue') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-maroon-500 rounded-full hover:bg-maroon-600 transition-all duration-300 hover:scale-105 shadow-lg">
                <i class="fas fa-th-large mr-2"></i>
                Lihat Semua Produk
            </a>
        </div>
    </div>
</section>


{{-- Portfolio Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">Portfolio</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Karya Terbaik Kami</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Lihat berbagai proyek berkualitas tinggi yang telah kami kerjakan</p>
        </div>



        @if(isset($portfolios) && count($portfolios) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($portfolios as $portfolio)
                    <div class="card card-hover group overflow-hidden">
                        <div class="relative overflow-hidden">
                            @if($portfolio->image)
                                <img src="{{ asset('storage/' . $portfolio->image) }}" 
                                     alt="{{ $portfolio->name }}" 
                                     class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-maroon-500 to-red-500 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-6xl opacity-50"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 right-4 transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <a href="{{ route('portfolio.detail', $portfolio->slug) }}" 
                                   class="inline-flex items-center text-white font-semibold hover:text-maroon-300 transition-colors">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors">
                                {{ $portfolio->name }}
                            </h3>
                            <div class="text-gray-600 line-clamp-3">
                                {!! Str::limit(strip_tags($portfolio->description), 120) !!}
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
                                @if($portfolio->product)
                                    <span class="inline-flex items-center text-xs bg-maroon-100 text-maroon-700 px-2 py-1 rounded-full font-medium">
                                        <i class="fas fa-box mr-1"></i>
                                        {{ $portfolio->product->nama_produk }}
                                    </span>
                                @endif
                                <span class="inline-flex items-center text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-full font-medium">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $portfolio->slug }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('portfolio') }}" 
                   class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-maroon-600 to-red-600 rounded-full hover:from-maroon-700 hover:to-red-700 transition-all duration-300 hover:scale-105 shadow-lg">
                    <i class="fas fa-folder-open mr-2"></i>
                    Lihat Semua Portfolio
                </a>
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-folder-open text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada portfolio</h3>
                <p class="text-gray-600">Portfolio proyek akan ditampilkan di sini</p>
            </div>
        @endif
    </div>
</section>


{{-- CTA Section --}}
<section class="py-20 bg-gradient-to-r from-maroon-600 to-red-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Siap Mewujudkan Proyek Impian Anda?
        </h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk kebutuhan percetakan Anda
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="https://wa.me/6287765748275" target="_blank"
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-maroon-600 bg-white rounded-full hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-lg">
                <i class="fab fa-whatsapp mr-2"></i>
                Chat WhatsApp
            </a>
            <a href="{{ route('contact.create') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-maroon-600 transition-all duration-300 hover:scale-105">
                <i class="fas fa-envelope mr-2"></i>
                Kirim Pesan
            </a>
        </div>
    </div>
</section>

{{-- Testimonials Section --}}
<section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">Testimoni</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Apa Kata Pelanggan Kami</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Kepuasan pelanggan adalah prioritas utama kami</p>
        </div>

        @if($testimonials->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="card card-hover p-8 relative">
                        <div class="absolute top-6 left-6 text-maroon-500/20">
                            <i class="fas fa-quote-left text-4xl"></i>
                        </div>
                        
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 mr-4">
                                @if($testimonial->picture)
                                    <img src="{{ asset('storage/' . $testimonial->picture) }}" 
                                         alt="{{ $testimonial->name }}" 
                                         class="w-12 h-12 rounded-full object-cover ring-4 ring-maroon-100">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-maroon-500 to-red-500 flex items-center justify-center text-white font-semibold">
                                        {{ substr($testimonial->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $testimonial->name }}</h4>
                                <div class="flex items-center mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        @else
                                            <i class="far fa-star text-gray-300 text-sm"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 leading-relaxed relative z-10">{{ $testimonial->description }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-200 rounded-full mb-4">
                    <i class="fas fa-comments text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada testimonial</h3>
                <p class="text-gray-600">Testimonial pelanggan akan ditampilkan di sini</p>
            </div>
        @endif
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
    
    /* Custom animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Slider
        const slides = document.querySelectorAll('[data-slide]');
        const indicators = document.querySelectorAll('[data-slide-to]');
        let currentSlide = 0;
        
        if (slides.length > 1) {
            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });
                
                indicators.forEach((indicator, i) => {
                    indicator.classList.toggle('bg-white', i === index);
                    indicator.classList.toggle('bg-white/30', i !== index);
                });
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }
            
            // Auto slide every 5 seconds
            setInterval(nextSlide, 5000);
            
            // Manual slide control
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
@endpush