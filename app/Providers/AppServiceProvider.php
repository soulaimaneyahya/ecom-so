<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // pagination
        Paginator::useBootstrap();

        // schema length default & use uuid as default mophid
        Schema::defaultStringLength(191);
        Builder::defaultMorphKeyType('uuid');
        
        // register blade components
        Blade::aliasComponent('components.alert', 'alert');
        Blade::aliasComponent('components.badge', 'badge');

        // register observers
        Product::observe(ProductObserver::class);
    }
}