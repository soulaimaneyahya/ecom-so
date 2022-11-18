<?php

namespace App\Providers;

use App\Http\View\Composers\CountComposer;
use App\Models\Product;
use App\Models\Category;
use App\Observers\ProductObserver;
use App\Observers\CategoryObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

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

        // view composer, pass data to views globally
        View::composer([
            'partials.sidebar',
            'admin.orders.index'
        ], CountComposer::class);

        // schema length default & use uuid as default mophid
        Schema::defaultStringLength(191);
        Builder::defaultMorphKeyType('uuid');
        
        // register blade components
        Blade::aliasComponent('components.alert', 'alert');
        Blade::aliasComponent('components.badge', 'badge');
        Blade::aliasComponent('components.sorted', 'sorted');
        Blade::aliasComponent('components.images', 'images');
        Blade::aliasComponent('components.footer', 'footer');

        // register observers
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
