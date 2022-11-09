<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface
{
    public function __construct
    (
        private Product $product,
    )
    {    
    }

    public function all()
    {
        $per_page = request('per_page') ?? 5;
        $q = request('q');
        $sort = request('sort_price');

        $products = $this->product
        ->select(['id', 'name', 'price', 'stock', 'created_at']);
        if ($q) {
            $products = $products->where('name', 'like', '%'. $q .'%');
        }
        if ($sort && in_array($sort, ["asc", "desc"])) {
            $products = $products->orderBy('price', $sort);
        } else {
            $products = $products->latest();
        }
        return $products
        ->paginate($per_page) // page = 1
        ->appends([
            'per_page' => $per_page, // &per_page=10
            'q' => $q, // &q=lorem
            'sort' => $sort, // &price_sort=desc
        ]);
    }
}