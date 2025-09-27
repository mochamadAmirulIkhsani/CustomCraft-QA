@extends('layouts.app')

@section('title', $portfolio->name . ' - Portfolio')

@section('content')
{{-- Breadcrumb --}}
<section class="py-6 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-maroon-600 transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('portfolio') }}" class="hover:text-maroon-600 transition-colors">Portfolio</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 font-medium">{{ $portfolio->name }}</span>
        </nav>
    </div>
</section>

{{-- Portfolio Detail --}}
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            {{-- Portfolio Image --}}
            <div class="order-2 lg:order-1">
                <div class="sticky top-8">
                    @if($portfolio->image)
                        <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                            <img src="{{ asset('storage/' . $portfolio->image) }}" 
                                 alt="{{ $portfolio->name }}" 
                                 class="w-full h-96 lg:h-[600px] object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="w-full h-96 lg:h-[600px] bg-gradient-to-br from-maroon-500 to-red-500 rounded-2xl flex items-center justify-center shadow-2xl">
                            <div class="text-center text-white">
                                <i class="fas fa-image text-8xl opacity-50 mb-4"></i>
                                <p class="text-xl font-medium">Gambar Portfolio</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Portfolio Info --}}
            <div class="order-1 lg:order-2">
                <div class="mb-6">
                    <div class="inline-flex items-center px-4 py-2 bg-maroon-100 text-maroon-800 rounded-full text-sm font-medium mb-4">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $portfolio->slug }}
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                        {{ $portfolio->name }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>Dibuat pada {{ $portfolio->created_at->format('d M Y') }}</span>
                        </div>
                        @if($portfolio->product)
                            <div class="flex items-center">
                                <i class="fas fa-box mr-2"></i>
                                <span>Produk: <strong class="text-maroon-600">{{ $portfolio->product->nama_produk }}</strong></span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Portfolio Description --}}
                <div class="prose prose-lg max-w-none mb-8">
                    <div class="text-gray-700 leading-relaxed">
                        {!! $portfolio->description !!}
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="https://wa.me/6287765748275?text=Halo, saya tertarik dengan portfolio '{{ $portfolio->name }}'. Bisakah kita diskusi lebih lanjut?" 
                       target="_blank"
                       class="inline-flex items-center justify-center px-6 py-3 text-lg font-semibold text-white bg-gradient-to-r from-maroon-600 to-red-600 rounded-full hover:from-maroon-700 hover:to-red-700 transition-all duration-300 hover:scale-105 shadow-lg">
                        <i class="fab fa-whatsapp mr-2"></i>
                        Diskusi Proyek Serupa
                    </a>
                    <a href="{{ route('contact.create') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 text-lg font-semibold text-maroon-600 bg-white border-2 border-maroon-600 rounded-full hover:bg-maroon-600 hover:text-white transition-all duration-300 hover:scale-105">
                        <i class="fas fa-envelope mr-2"></i>
                        Kirim Pesan
                    </a>
                </div>

                {{-- Back to Portfolio --}}
                <div class="pt-8 border-t border-gray-200">
                    <a href="{{ route('portfolio') }}" 
                       class="inline-flex items-center text-maroon-600 hover:text-maroon-700 font-medium transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Portfolio
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Projects Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Portfolio Lainnya</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Lihat proyek-proyek berkualitas lainnya yang telah kami kerjakan</p>
        </div>

        @if($relatedPortfolios->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedPortfolios as $related)
                    <div class="card card-hover group overflow-hidden bg-white">
                        <div class="relative overflow-hidden">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" 
                                     alt="{{ $related->name }}" 
                                     class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-110">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-maroon-500 to-red-500 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-4xl opacity-50"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 right-4 transform translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <a href="{{ route('portfolio.detail', $related->slug) }}" 
                                   class="inline-flex items-center text-white font-semibold hover:text-maroon-300 transition-colors">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-maroon-600 transition-colors">
                                {{ $related->name }}
                            </h3>
                            <div class="text-gray-600 text-sm line-clamp-2">
                                {!! Str::limit(strip_tags($related->description), 100) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-folder-open text-2xl text-gray-400"></i>
                </div>
                <p class="text-gray-600">Belum ada portfolio lainnya untuk ditampilkan.</p>
            </div>
        @endif
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
    
    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
        color: #7f1d1d;
    }
    
    .prose ul {
        list-style-type: disc;
        padding-left: 1.5rem;
    }
    
    .prose ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
    }
    
    .prose li {
        margin: 0.5rem 0;
    }
    
    .prose p {
        margin: 1rem 0;
    }
</style>
@endpush