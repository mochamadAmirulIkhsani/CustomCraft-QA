@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

{{-- Hero Section --}}
<section class="relative py-20 bg-gradient-to-br from-maroon-600 via-maroon-500 to-red-500 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Tentang <span class="text-yellow-400">CustomCraft</span>
        </h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto">
            Rumah bagi para pengrajin kreatif yang mencintai keunikan dan sentuhan personal dalam setiap karya
        </p>
    </div>
</section>

{{-- Company Stats --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="group">
                <div class="bg-gradient-to-br from-maroon-500 to-red-500 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold group-hover:scale-110 transition-transform duration-300">
                    30K+
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Happy Customers</h3>
                <p class="text-gray-600">Pelanggan yang puas dengan layanan kami</p>
            </div>
            <div class="group">
                <div class="bg-gradient-to-br from-maroon-500 to-red-500 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold group-hover:scale-110 transition-transform duration-300">
                    5★
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Perfect Rating</h3>
                <p class="text-gray-600">Rating sempurna dari pelanggan</p>
            </div>
            <div class="group">
                <div class="bg-gradient-to-br from-maroon-500 to-red-500 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold group-hover:scale-110 transition-transform duration-300">
                    100+
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Products</h3>
                <p class="text-gray-600">Berbagai macam produk percetakan</p>
            </div>
            <div class="group">
                <div class="bg-gradient-to-br from-maroon-500 to-red-500 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold group-hover:scale-110 transition-transform duration-300">
                    10+
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Years Experience</h3>
                <p class="text-gray-600">Tahun pengalaman di bidang percetakan</p>
            </div>
        </div>
    </div>
</section>

{{-- Main Story Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4">
                        <div class="card card-hover p-6 text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="CustomCraft" 
                                 class="w-20 h-20 rounded-full mx-auto mb-4 shadow-lg">
                            <h4 class="font-bold text-gray-900">CustomCraft</h4>
                            <p class="text-sm text-gray-600">Premium Quality</p>
                        </div>
                        <div class="card card-hover p-4">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-star text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="font-semibold text-gray-900">Best Rating</h5>
                                    <div class="flex space-x-1 text-yellow-400">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 space-y-4">
                        <div class="card card-hover p-4">
                            <h5 class="font-bold text-gray-900 mb-2">30,000+</h5>
                            <p class="text-gray-600 text-sm mb-3">Sales dengan rating 5-star dan pelanggan bahagia</p>
                            <div class="flex flex-wrap gap-1">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="w-6 h-6 bg-gradient-to-br from-maroon-500 to-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-xs"></i>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="card card-hover p-6 text-center">
                            <img src="{{ asset('images/logo.png') }}" alt="CustomCraft Small" 
                                 class="w-16 h-16 rounded-full mx-auto mb-3 shadow-md">
                            <h5 class="font-bold text-gray-900 text-sm">CustomCraft</h5>
                            <p class="text-xs text-gray-600">Your Creative Partner</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="order-1 lg:order-2">
                <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">A Bit</p>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">About Us</h2>
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                    <p>
                        <strong class="text-gray-900">CustomCraft</strong> adalah rumah bagi para pengrajin kreatif yang mencintai 
                        keunikan dan sentuhan personal dalam setiap karya. Kami percaya bahwa setiap produk buatan tangan 
                        memiliki cerita dan jiwa di baliknya.
                    </p>
                    <p>
                        Dengan pengalaman bertahun-tahun di industri percetakan, kami telah membantu ribuan pelanggan 
                        mewujudkan ide kreatif mereka menjadi produk berkualitas tinggi yang membanggakan.
                    </p>
                    <p>
                        Dari kartu nama profesional hingga banner besar untuk acara khusus, setiap produk yang kami hasilkan 
                        dibuat dengan perhatian detail dan standar kualitas tertinggi.
                    </p>
                </div>
                <div class="mt-8">
                    <a href="{{ route('catalogue') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-maroon-500 rounded-full hover:bg-maroon-600 transition-all duration-300 hover:scale-105 shadow-lg">
                        <i class="fas fa-compass mr-2"></i>
                        Jelajahi Produk
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">Nilai-Nilai Kami</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih CustomCraft?</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Komitmen kami terhadap excellence dalam setiap aspek layanan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-medal text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kualitas Unggul</h3>
                <p class="text-gray-600 leading-relaxed">
                    Setiap produk dibuat dengan perhatian penuh terhadap detail dan standar tertinggi untuk hasil yang memuaskan
                </p>
            </div>
            
            <div class="group text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-clock text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Tepat Waktu</h3>
                <p class="text-gray-600 leading-relaxed">
                    Komitmen pada ketepatan waktu, memastikan setiap produk selesai sesuai jadwal yang telah disepakati
                </p>
            </div>
            
            <div class="group text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-lightbulb text-3xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Kreativitas & Inovasi</h3>
                <p class="text-gray-600 leading-relaxed">
                    Kreativitas tanpa batas dan inovasi berkelanjutan untuk memastikan produk Anda selalu unik dan menarik
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Team Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-maroon-500 font-semibold text-sm uppercase tracking-wider mb-2">Tim Kami</p>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Orang-Orang Di Balik CustomCraft</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Tim profesional yang berdedikasi untuk menghadirkan hasil terbaik
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group text-center">
                <div class="card card-hover p-8">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-maroon-500 to-red-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        M
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Creative Director</h3>
                    <p class="text-gray-600 mb-4">Memimpin tim kreatif untuk menghasilkan desain yang inovatif dan menarik</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-maroon-500 transition-colors duration-200">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-maroon-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="group text-center">
                <div class="card card-hover p-8">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-maroon-500 to-red-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        P
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Production Manager</h3>
                    <p class="text-gray-600 mb-4">Mengawasi proses produksi untuk memastikan kualitas dan ketepatan waktu</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-maroon-500 transition-colors duration-200">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-maroon-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="group text-center">
                <div class="card card-hover p-8">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-maroon-500 to-red-500 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        C
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Customer Relations</h3>
                    <p class="text-gray-600 mb-4">Memastikan kepuasan pelanggan dan memberikan layanan terbaik</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-maroon-500 transition-colors duration-200">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-maroon-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-20 bg-gradient-to-r from-maroon-600 to-red-600">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Siap Berkolaborasi Dengan Kami?
        </h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Mari wujudkan ide kreatif Anda bersama tim profesional CustomCraft
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('catalogue') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-maroon-600 bg-white rounded-full hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-lg">
                <i class="fas fa-eye mr-2"></i>
                Lihat Portfolio
            </a>
            <a href="{{ route('contact.create') }}" 
               class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-full hover:bg-white hover:text-maroon-600 transition-all duration-300 hover:scale-105">
                <i class="fas fa-comments mr-2"></i>
                Mulai Diskusi
            </a>
        </div>
    </div>
</section>

@endsection
