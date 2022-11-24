<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function category(Category $category)
    {
        $products = $category->products()
            ->where('status', 'active')
            ->latest()
            ->paginate('12');
        return view('front.pages.category', compact('category', 'products'));
    }

    public function product(Product $product)
    {

    }
}
