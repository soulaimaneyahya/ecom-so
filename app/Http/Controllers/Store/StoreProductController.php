<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;

class StoreProductController extends Controller
{
    public function show(Product $product)
    {
        dd($product);
    }
}
