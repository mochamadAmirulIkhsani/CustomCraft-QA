<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Show the about page with team members
     */
    public function index(): View
    {
        // Get active team members ordered by sort_order
        $teams = Team::active()->ordered()->get();

        return view('pages.about', compact('teams'));
    }
}
