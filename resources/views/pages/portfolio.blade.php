@extends('layouts.app')

@section('title', 'Portfolio Kami')

@section('content')
{{-- Hero Section --}}
<section class="relative bg-gradient-to-br from-maroon-600 to-red-600 py-20">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Portfolio Kami
        </h1>
        <p class="text-xl sm:text-2xl mb-8 max-w-3xl mx-auto opacity-90">
            Lihat berbagai proyek berkualitas tinggi yang telah kami kerjakan dengan dedikasi dan profesionalitas
        </p>
        <div class="flex items-center justify-center space-x-4 text-lg">
            <span class="flex items-center">
                <i class="fas fa-briefcase mr-2"></i>
                {{ $portfolios->count() }} Proyek
            </span>
            <span class="opacity-50">•</span>
            <span class="flex items-center">
                <i class="fas fa-award mr-2"></i>
                Kualitas Terjamin
            </span>
        </div>
    </div>
</section>

{{-- Portfolio Grid Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($portfolios->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($portfolios as $portfolio)
                    <div class="card card-hover group overflow-hidden bg-white">
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
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-maroon-600 transition-colors">
                                {{ $portfolio->name }}
                            </h3>
                            <div class="text-gray-600 line-clamp-3 mb-4">
                                {!! Str::limit(strip_tags($portfolio->description), 150) !!}
                            </div>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="inline-flex items-center text-sm text-maroon-600 font-medium">
                                    <i class="fas fa-tag mr-1"></i>
                                    {{ $portfolio->slug }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    {{ $portfolio->created_at->format('M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Portfolio Stats --}}
            <div class="mt-16 bg-white rounded-2xl shadow-lg p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-maroon-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-briefcase text-2xl text-maroon-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $portfolios->count() }}+</h3>
                        <p class="text-gray-600">Proyek Selesai</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-maroon-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-users text-2xl text-maroon-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">50+</h3>
                        <p class="text-gray-600">Klien Puas</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-maroon-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-award text-2xl text-maroon-600"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">100%</h3>
                        <p class="text-gray-600">Kualitas Terjamin</p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-32 h-32 mx-auto mb-8 rounded-full bg-gray-100 flex items-center justify-center">
                    <i class="fas fa-folder-open text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Belum Ada Portfolio</h3>
                <p class="text-lg text-gray-600 mb-8">Portfolio proyek akan ditampilkan di sini setelah ditambahkan.</p>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-6 py-3 text-lg font-semibold text-white bg-maroon-600 rounded-full hover:bg-maroon-700 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-gradient-to-r from-maroon-600 to-red-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Tertarik dengan Karya Kami?
        </h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Hubungi kami sekarang untuk mendiskusikan proyek impian Anda dan dapatkan konsultasi gratis
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