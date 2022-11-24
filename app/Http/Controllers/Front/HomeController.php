<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('status', 'Active')
            ->where('featured', 'Yes')
            ->limit(4)
            ->inRandomOrder()
            ->get();

        $latestProducts = Product::where('status', 'Active')
            ->limit(4)
            ->latest()
            ->get();

        return view('front.home.index', compact('featuredProducts', 'latestProducts'));
    }
}
