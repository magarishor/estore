<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
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
    }
}
