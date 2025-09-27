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
        $portfolios = Portfolio::where('is_active', true)
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

        return view('pages.portfolio-detail', compact('portfolio'));
    }
}
