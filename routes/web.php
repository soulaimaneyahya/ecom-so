<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Store\StoreProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['is_admin']], function(){
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('users', UserController::class);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(StoreProductController::class)->prefix('store')->as('store.')->group(function () {
   
    Route::get('/','index')->name('index');
    Route::get('/categories/{category}/products','shop')->name('shop');
    Route::get('/shop','shop')->name('shop');

});