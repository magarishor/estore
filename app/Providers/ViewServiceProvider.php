<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['cms.products.create', 'cms.products.edit'], function ($view){

            $categories = Category::select(['id', 'name'])->where('status','Active')->get();
            $brands = Brand::select(['id', 'name'])->where('status', 'Active')->get();
            $view->with(compact('categories','brands'));

        });

        View::composer('front.includes.nav', function ($view){
            $categories = Category::select(['id', 'name'])->where('status','Active')->get();
            $view->with(compact('categories'));
        });

        View::composer('front.layout.front', function ($view){
            $cart = [];
            if(Request::hasCookie('estore_cart')) {
                $cart = json_decode(Request::cookie('estore_cart'), true);
            }

            $cart = collect($cart);

            $total_qty = $cart->sum('qty');
            $total_amount = number_format($cart->sum('total'));
            $view->with(compact('total_qty', 'total_amount'));

        });
    }
}
