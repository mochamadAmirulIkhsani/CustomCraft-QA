<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE HALAMAN UTAMA & STATIS ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', function () {
    return view('pages.about');
})->name('aboutus');


// --- RUTE PRODUK ---
Route::get('/catalogue', [ProductController::class, 'index'])->name('catalogue');
Route::get('/produk/{product}', [ProductController::class, 'show'])->name('product.detail');


// --- RUTE FORMULIR KONTAK ---
// Rute untuk MENAMPILKAN formulir (method GET)
// Saya ganti namanya menjadi 'contact.create' agar lebih sesuai standar
Route::get('/contact-us', [ContactController::class, 'create'])->name('contact.create');

// Rute untuk MENGIRIM data formulir (method POST)
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
