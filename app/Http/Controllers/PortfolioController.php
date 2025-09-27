<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Contracts\View\View;

class PortfolioController extends Controller
{
    /**
     * Display all active portfolios
     */
    public function index(): View
    {
        $portfolios = Portfolio::with('product') // Load relasi product
                              ->where('is_active', true)
                              ->latest()
                              ->get();

        return view('pages.portfolio', compact('portfolios'));
    }

    /**
     * Display specific portfolio by slug
     */
    public function show(Portfolio $portfolio): View
    {
        // Ensure the portfolio is active
        if (!$portfolio->is_active) {
            abort(404);
        }

        // Load product relation
        $portfolio->load('product');

        // Get related portfolios (other active portfolios excluding current one)
        // Using select to only fetch needed columns for better performance
        $relatedPortfolios = Portfolio::where('is_active', true)
            ->where('id', '!=', $portfolio->id)
            ->select(['id', 'name', 'slug', 'description', 'image'])
            ->latest()
            ->take(3)
            ->get();

        return view('pages.portfolio-detail', compact('portfolio', 'relatedPortfolios'));
    }
}
