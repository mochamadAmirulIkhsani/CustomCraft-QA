<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Show the list of products.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Get the list of products ordered by the latest one first
        $query = request()->query('q');

        $products = Product::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('nama_produk', 'like', '%' . $query . '%');
        })->latest()->get();

        return view('pages.catalogue', [
            'products' => $products,
            'searchQuery' => $query, // opsional, untuk ditampilkan kembali di input
        ]);
    }

    public function show(Product $product): View
    {
        return view('pages.product-detail', ['product' => $product]);
    }
}
