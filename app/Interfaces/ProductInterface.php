<?php

namespace App\Interfaces;

use App\Models\Product;

interface ProductInterface
{
    public function all();

    public function find(Product $product);
}
