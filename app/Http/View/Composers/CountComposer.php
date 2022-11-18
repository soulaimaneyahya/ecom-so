<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\OrderService;
use App\Services\ReviewService;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Cache;

class CountComposer
{
    public function __construct(
        private OrderService $orderService,
        private ProductService $productService,
        private ReviewService $reviewService,
        private CategoryService $categoryService,
    ) {
    }
    
    public function compose(View $view)
    {
        $ordersCount = Cache::remember('orders-count', 100, function(){
            return $this->orderService->count();
        });
        $view->with('ordersCount', $ordersCount);
    }
}
