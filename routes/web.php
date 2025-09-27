<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PortfolioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE HALAMAN UTAMA & STATIS ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [AboutController::class, 'index'])->name('aboutus');


// --- RUTE PRODUK ---
Route::get('/catalogue', [ProductController::class, 'index'])->name('catalogue');
Route::get('/produk/{product}', [ProductController::class, 'show'])->name('product.detail');


// --- RUTE PORTFOLIO ---
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.detail');


// --- RUTE FORMULIR KONTAK ---
// Rute untuk MENAMPILKAN formulir (method GET)
// Saya ganti namanya menjadi 'contact.create' agar lebih sesuai standar
Route::get('/contact-us', [ContactController::class, 'create'])->name('contact.create');

// Rute untuk MENGIRIM data formulir (method POST)
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');
