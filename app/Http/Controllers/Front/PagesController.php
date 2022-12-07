<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function brand(Brand $brand)
    {
        $products = $brand->products()
            ->where('status', 'active')
            ->latest()
            ->paginate('12');
        return view('front.pages.brand', compact('brand', 'products'));
    }


    public function product(Product $product)
    {
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('status', 'Active')
            ->where('id','!=', $product->id)
            ->inRandomOrder()
            ->Limit(4)
            ->get();
        $reviews = $product->reviews;
        return view('front.pages.product', compact('product', 'similarProducts', 'reviews'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'like', '%'.$request->term.'%')
        ->where('status', 'Active')
        ->latest()
        ->paginate(12);

        return view('front.pages.search', compact('products'));
    }

    public function comment(Request $request, $id)
    {
        $validated = $request->validate([
          'comment' => 'required|string',
          'rating' => 'required|min:1|max:5',
        ]);

        $validated['product_id'] = $id;
        $validated['user_id'] = Auth::id();

        Review::create($validated);

        flash('Thank you for your review.')->success();

        return redirect()->route('front.pages.product', $id);
    }
}
