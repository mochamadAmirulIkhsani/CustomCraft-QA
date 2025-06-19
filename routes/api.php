<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/products', App\Http\Controllers\ProductController::class);

Route::apiResource('/banners', App\Http\Controllers\BannerController::class  );


// Route::get('/product', [ProductController::class, 'index'] );
// Route::get('/product/{id}', [ProductController::class, 'show'] );
// Route::get('/banners', [BannerController::class, 'index'] );
// Route::get('/banners/{api}', [BannerController::class, 'show'] );
