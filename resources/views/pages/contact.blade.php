@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
    <div class="container my-5 py-5">
        <div class="row contact-card-modern shadow">

            <!-- Panel Kiri: Informasi Kontak Modern -->
            <div class="col-lg-5 contact-left-panel">
                <h3 class="fw-bolder mb-3">Get in Touch</h3>
                <p class="mb-5">Kami senang mendengar dari Anda. Hubungi kami melalui detail di bawah ini.</p>

                <ul class="contact-info-list list-unstyled">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Pisang Kipas No.10a Kota Malang</span>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        <span>Customcraftmlg@Gmail.Com</span>
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill"></i>
                        <span>0813-5929-4714</span>
                    </li>
                </ul>

                <div class="social-icons mt-auto">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>

            <!-- Panel Kanan: Formulir Modern -->
            <div class="col-lg-7 contact-right-panel">
                <h3 class="fw-bold mb-4">Tulis Pesan Anda</h3>

                {{-- Menampilkan pesan sukses & error --}}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                 <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" name="first_name" class="form-control" id="firstName"
                                placeholder="Nama Depan" value="{{ old('first_name') }}" required>
                            <label for="firstName">Nama Depan</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" name="last_name" class="form-control" id="lastName"
                                placeholder="Nama Belakang" value="{{ old('last_name') }}" required>
                            <label for="lastName">Nama Belakang</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="email" name="email" class="form-control" id="email"
                                placeholder="Email Anda" value="{{ old('email') }}" required>
                            <label for="email">Email Anda</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" name="phone" class="form-control" id="phone"
                                placeholder="Nomor Telepon" value="{{ old('phone') }}">
                            <label for="phone">Nomor Telepon (Opsional)</label>
                        </div>

                        <div class="col-12 mt-4">
                            <label class="form-label fw-semibold">Pilih Subjek</label>
                            <div class="subject-selector d-flex flex-wrap gap-2">
                                <div class="subject-option active" data-value="Pertanyaan Umum">Pertanyaan Umum</div>
                                <div class="subject-option" data-value="Dukungan Teknis">Dukungan Teknis</div>
                                <div class="subject-option" data-value="Penawaran">Penawaran</div>
                            </div>
                            <input type="hidden" name="subject" id="subject-input" value="Pertanyaan Umum">
                        </div>

                        <div class="col-12 form-floating mt-3">
                            <textarea name="message" class="form-control" placeholder="Tulis pesan Anda.." id="message" style="height: 120px"
                                required>{{ old('message') }}</textarea>
                            <label for="message">Tulis pesan Anda..</label>
                        </div>

                        <div class="col-12 mt-4">
                            <button class="btn btn-lg contact-btn" type="submit">
                                Kirim Pesan <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    {{-- Pastikan Bootstrap Icons sudah ada di layouts/app.blade.php --}}
    <style>
        .contact-card-modern {
            border-radius: 24px;
            overflow: hidden;
            /* Penting untuk menjaga sudut membulat */
            background-color: #f8f9fa;
        }

        /* --- Panel Kiri --- */
        .contact-left-panel {
            background: #94171d;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
        }

        .contact-info-list li {
            display: flex;
            align-items: start;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .contact-info-list i {
            font-size: 1.25rem;
            margin-right: 1rem;
            margin-top: 2px;
            color: rgba(255, 255, 255, 0.8);
        }

        .social-icons a {
            color: white;
            font-size: 1.5rem;
            margin-right: 1rem;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .social-icons a:hover {
            opacity: 1;
        }

        /* --- Panel Kanan --- */
        .contact-right-panel {
            padding: 3rem;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 1rem;
        }

        .form-control:focus {
            border-color: #94171d;
            box-shadow: 0 0 0 0.25rem rgba(148, 23, 29, 0.25);
        }

        .form-floating>label {
            padding: 1rem;
        }

        /* --- Selektor Subjek Interaktif --- */
        .subject-option {
            padding: 8px 16px;
            border: 1px solid #ccc;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .subject-option:hover {
            background-color: #f1f1f1;
        }

        .subject-option.active {
            background-color: #94171d;
            color: white;
            border-color: #94171d;
        }

        /* --- Tombol Kirim Modern --- */
        .contact-btn {
            background-color: #94171d;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-btn:hover {
            background-color: #c82333;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            color: white;
        }
    </style>
@endpush


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subjectOptions = document.querySelectorAll('.subject-option');
            const subjectInput = document.getElementById('subject-input');

            subjectOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Hapus kelas 'active' dari semua opsi
                    subjectOptions.forEach(opt => opt.classList.remove('active'));

                    // Tambahkan kelas 'active' ke opsi yang diklik
                    this.classList.add('active');

                    // Update nilai input yang tersembunyi
                    subjectInput.value = this.dataset.value;
                });
            });
        });
    </script>
@endpush
