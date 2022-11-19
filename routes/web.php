<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Store\StoreController;
use App\Http\Controllers\Orders\OrdersController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Reviews\ReviewsController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Store\StoreProductController;
use App\Http\Controllers\Store\StoreCategoryController;
use App\Http\Controllers\Product\ProductImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['is_admin']], function () {
        Route::resource('orders', OrdersController::class);
        
        Route::post('products/images', [ProductImageController::class, 'store'])->name('products.images.store');
        Route::resource('products', ProductController::class);
        
        Route::resource('categories', CategoryController::class);

        Route::POST('reviews/{review}/approved', [ReviewsController::class, 'approved'])->name('reviews.approved');
        Route::resource('reviews', ReviewsController::class)->except('show');
        
        Route::resource('users', UserController::class);
    });
});

Route::group(['prefix' => 'store', 'as' => 'store.'], function () {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::resource('products', StoreProductController::class)->only(['show']);
    Route::resource('categories', StoreCategoryController::class)->only(['show']);
});
