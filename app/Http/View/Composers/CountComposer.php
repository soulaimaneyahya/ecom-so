<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Services\OrderService;
use App\Services\ReviewService;
use App\Services\ProductService;
use App\Services\CategoryService;

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
        $ordersCount = $this->orderService->count();
        $view->with('ordersCount', $ordersCount);

        $productsCount = $this->productService->count();
        $view->with('productsCount', $productsCount);

        $reviewsCount = $this->reviewService->count();
        $view->with('reviewsCount', $reviewsCount);

        $categoriesCount = $this->categoryService->count();
        $view->with('categoriesCount', $categoriesCount);
    }
}
