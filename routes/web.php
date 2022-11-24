<?php

use App\Http\Controllers\Back\BrandsController;
use App\Http\Controllers\Back\CategoriesController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\PasswordController;
use App\Http\Controllers\Back\ProductController;
use App\Http\Controllers\Back\ProfileController;
use App\Http\Controllers\Back\StaffsController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/cms')->name('cms.')->group(function () {

    Route::middleware('auth:cms')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');

        Route::match(['put', 'patch'], '/edit-profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.edit');

        Route::match(['put', 'patch'], '/change-password', [PasswordController::class, 'update'])->name('password.update');

        Route::resource('/staffs', StaffsController::class)->except('show')->middleware('admin.access');

        Route::get('/products/{product}/image/{filename}', [ProductController::class, 'destroyImage'])->name('products.image');

        Route::resources([
            'categories' => CategoriesController::class,
            'brands' => BrandsController::class,
            'products' => ProductController::class
        ],['except' =>['show']]);

    });

    Route::controller(LoginController::class)->group(function () {

        Route::get('/login', 'showLoginForm')->name('login.show');

        Route::post('/login', 'login')->name('login.check');

    });

});

Route::name('front.')->group(function (){

    Route::get('/category/{category}',[PagesController::class, 'category'])->name('pages.category');
    Route::get('/product/{product}', [PagesController::class, 'product'])->name('pages.product');
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

});
