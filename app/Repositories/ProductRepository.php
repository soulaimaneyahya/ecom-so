<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductInterface;

class ProductRepository implements ProductInterface
{
    public $q;
    public $per_page;
    public $sort;

    public function __construct(
        private Product $product,
    ) {
        $this->q = request('q');
        $this->per_page = request('per_page') ?? 5;
        $this->sort = request('sort');
    }
    
    public function all()
    {
        $products = $this->product
        ->with(['images'])
        ->select(['id', 'name', 'price', 'slug', 'stock', 'created_at']);

        if ($this->q) {
            $products = $products->where('name', 'like', '%'. $this->q .'%');
        }
        if ($this->sort &&
            in_array($this->sort, [
            "name-asc", "name-desc", "price-asc", "price-desc",
            "stock-asc", "stock-desc", "created_at-asc",
            "created_at-desc", "updated_at-asc", "updated_at-desc"
        ])) {
            $request = explode("-", $this->sort);
            
            $field = $request[0];
            $value = $request[1];
            
            $products = $products->orderBy($field, $value);
        } else {
            $products = $products->latest();
        }

        return $products
        ->paginate($this->per_page) // page = 1
        ->appends([
            'per_page' => $this->per_page, // &per_page=10
            'q' => $this->q, // &q=lorem
            'sort' => $this->sort, // &price_sort=desc
        ]);
    }

    public function find(Product $product)
    {
        return $product;
    }

    public function count()
    {
        return $this->product->get(['id'])->count();
    }
}
