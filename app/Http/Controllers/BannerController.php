<?php

namespace App\Http\Controllers;

use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        // Retrieve all banners from the database
        return Banner::all();
    }


    public function show($id){
        return Banner::find($id);
    }
}
