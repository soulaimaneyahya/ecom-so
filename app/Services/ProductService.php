<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct
    (
        private ProductRepository $productRepository,
        private Product $product,
    )
    {
    }
    
    public function all()
    {
        return $this->productRepository->all();
    }

    public function store(array $data)
    {
        return $this->product->create($data);
    }

    public function update(array $data, Product $product)
    {
        return $product->update($data);
    }
}
