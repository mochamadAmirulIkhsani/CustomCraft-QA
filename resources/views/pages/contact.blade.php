@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')

{{-- Hero Section --}}
<section class="relative py-20 bg-gradient-to-br from-maroon-600 via-maroon-500 to-red-500 overflow-hidden">
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Hubungi <span class="text-yellow-400">Kami</span>
        </h1>
        <p class="text-xl text-gray-200 max-w-3xl mx-auto">
            Kami senang mendengar dari Anda. Mari diskusikan bagaimana kami dapat membantu mewujudkan ide kreatif Anda
        </p>
    </div>
</section>

{{-- Contact Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            {{-- Contact Information --}}
            <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Mari Terhubung</h2>
                    <p class="text-lg text-gray-600">
                        Tim kami siap membantu Anda dengan segala pertanyaan dan kebutuhan percetakan Anda.
                    </p>
                </div>
                
                {{-- Contact Details --}}
                <div class="space-y-6 mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-maroon-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                            <p class="text-gray-600">Jl. Pisang Kipas No.10a<br>Kota Malang, Jawa Timur</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-maroon-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                            <a href="mailto:Customcraftmlg@Gmail.Com" class="text-maroon-600 hover:text-maroon-700 transition-colors duration-200">
                                Customcraftmlg@Gmail.Com
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-maroon-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-phone text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                            <a href="tel:08135929714" class="text-maroon-600 hover:text-maroon-700 transition-colors duration-200">
                                0813-5929-4714
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                            <i class="fab fa-whatsapp text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">WhatsApp</h3>
                            <a href="https://wa.me/6287765748275" target="_blank" 
                               class="text-green-600 hover:text-green-700 transition-colors duration-200">
                                +62 877-6574-8275
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Social Media --}}
                <div>
                    <h3 class="font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 rounded-lg flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Contact Form --}}
            <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Kirim Pesan</h2>
                    <p class="text-lg text-gray-600">
                        Isi form di bawah ini dan kami akan merespons secepat mungkin.
                    </p>
                </div>
                
                {{-- Success/Error Messages --}}
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <ul class="text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    {{-- Name Fields --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nama Depan *
                            </label>
                            <input type="text" 
                                   name="first_name" 
                                   id="first_name"
                                   value="{{ old('first_name') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-colors duration-200">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nama Belakang *
                            </label>
                            <input type="text" 
                                   name="last_name" 
                                   id="last_name"
                                   value="{{ old('last_name') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-colors duration-200">
                        </div>
                    </div>
                    
                    {{-- Email & Phone --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-colors duration-200">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-900 mb-2">
                                Nomor Telepon
                            </label>
                            <input type="text" 
                                   name="phone" 
                                   id="phone"
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-colors duration-200">
                        </div>
                    </div>
                    
                    {{-- Subject --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-4">Subjek *</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="subject" value="Pertanyaan Umum" class="sr-only peer" checked>
                                <div class="peer-checked:bg-maroon-500 peer-checked:text-white peer-checked:border-maroon-500 border-2 border-gray-300 rounded-lg p-3 text-center text-sm font-medium text-gray-700 hover:border-maroon-300 transition-colors duration-200">
                                    Pertanyaan Umum
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="subject" value="Dukungan Teknis" class="sr-only peer">
                                <div class="peer-checked:bg-maroon-500 peer-checked:text-white peer-checked:border-maroon-500 border-2 border-gray-300 rounded-lg p-3 text-center text-sm font-medium text-gray-700 hover:border-maroon-300 transition-colors duration-200">
                                    Dukungan Teknis
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="subject" value="Penawaran" class="sr-only peer">
                                <div class="peer-checked:bg-maroon-500 peer-checked:text-white peer-checked:border-maroon-500 border-2 border-gray-300 rounded-lg p-3 text-center text-sm font-medium text-gray-700 hover:border-maroon-300 transition-colors duration-200">
                                    Penawaran
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    {{-- Message --}}
                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">
                            Pesan *
                        </label>
                        <textarea name="message" 
                                  id="message" 
                                  rows="6"
                                  required
                                  placeholder="Tulis pesan Anda di sini..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-maroon-500 focus:border-maroon-500 transition-colors duration-200 resize-none">{{ old('message') }}</textarea>
                    </div>
                    
                    {{-- Submit Button --}}
                    <div class="pt-4">
                        <button type="submit" 
                                class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-maroon-500 rounded-lg hover:bg-maroon-600 focus:ring-4 focus:ring-maroon-500/20 transition-all duration-300 hover:scale-105 shadow-lg">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Quick Contact Options --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Cara Cepat Menghubungi Kami</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Pilih cara yang paling nyaman untuk Anda berkomunikasi dengan tim kami
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="https://wa.me/6287765748275" target="_blank" 
               class="group block p-8 bg-green-50 rounded-2xl border-2 border-green-100 hover:border-green-300 transition-all duration-300 hover:shadow-lg">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fab fa-whatsapp text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">WhatsApp</h3>
                    <p class="text-gray-600 mb-4">Chat langsung untuk respon cepat</p>
                    <span class="inline-flex items-center text-green-600 font-semibold group-hover:text-green-700">
                        Chat Sekarang
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </span>
                </div>
            </a>
            
            <a href="mailto:Customcraftmlg@Gmail.Com" 
               class="group block p-8 bg-blue-50 rounded-2xl border-2 border-blue-100 hover:border-blue-300 transition-all duration-300 hover:shadow-lg">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-envelope text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600 mb-4">Kirim detail project Anda</p>
                    <span class="inline-flex items-center text-blue-600 font-semibold group-hover:text-blue-700">
                        Kirim Email
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </span>
                </div>
            </a>
            
            <a href="tel:08135929714" 
               class="group block p-8 bg-maroon-50 rounded-2xl border-2 border-maroon-100 hover:border-maroon-300 transition-all duration-300 hover:shadow-lg">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-maroon-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-phone text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600 mb-4">Konsultasi langsung dengan tim</p>
                    <span class="inline-flex items-center text-maroon-600 font-semibold group-hover:text-maroon-700">
                        Hubungi Kami
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-200"></i>
                    </span>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Pertanyaan Yang Sering Diajukan</h2>
            <p class="text-lg text-gray-600">
                Temukan jawaban untuk pertanyaan umum seputar layanan kami
            </p>
        </div>
        
        <div class="space-y-4">
            <div class="bg-white rounded-lg shadow-sm">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" 
                        onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Berapa lama waktu pengerjaan untuk pesanan?</span>
                    <i class="fas fa-plus text-maroon-500 transition-transform duration-200"></i>
                </button>
                <div class="hidden px-6 pb-4">
                    <p class="text-gray-600">Waktu pengerjaan bervariasi tergantung jenis dan kompleksitas produk. Umumnya 2-5 hari kerja untuk produk standar, dan 7-14 hari untuk produk custom yang lebih kompleks.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" 
                        onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Apakah ada minimum order untuk setiap produk?</span>
                    <i class="fas fa-plus text-maroon-500 transition-transform duration-200"></i>
                </button>
                <div class="hidden px-6 pb-4">
                    <p class="text-gray-600">Minimum order bervariasi per produk. Untuk kartu nama mulai dari 100 pcs, banner mulai dari 1 pcs, dan sticker mulai dari 50 pcs. Silakan hubungi kami untuk informasi detail.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" 
                        onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Bagaimana cara pembayaran yang tersedia?</span>
                    <i class="fas fa-plus text-maroon-500 transition-transform duration-200"></i>
                </button>
                <div class="hidden px-6 pb-4">
                    <p class="text-gray-600">Kami menerima pembayaran melalui transfer bank, e-wallet (GoPay, OVO, DANA), dan cash untuk pengambilan langsung di lokasi kami.</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-sm">
                <button class="w-full px-6 py-4 text-left flex items-center justify-between focus:outline-none" 
                        onclick="toggleFaq(this)">
                    <span class="font-semibold text-gray-900">Apakah ada layanan pengiriman?</span>
                    <i class="fas fa-plus text-maroon-500 transition-transform duration-200"></i>
                </button>
                <div class="hidden px-6 pb-4">
                    <p class="text-gray-600">Ya, kami menyediakan layanan pengiriman ke seluruh Indonesia melalui kurir terpercaya. Biaya pengiriman akan dihitung berdasarkan berat dan tujuan pengiriman.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function toggleFaq(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('i');
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.remove('fa-plus');
            icon.classList.add('fa-minus');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.classList.remove('fa-minus');
            icon.classList.add('fa-plus');
            icon.style.transform = 'rotate(0deg)';
        }
    }
</script>
@endpush
