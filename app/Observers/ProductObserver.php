<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class ProductObserver
{
    // saving, it's before creating & updating
    public function saving(Product $product)
    {
        Cache::forget("products-count");
        $product->slug = Str::slug($product->slug);
    }

    public function deleting(Product $product)
    {
        Cache::forget("products-count");
        foreach ($product->images as $image) {
            $image->delete();
        }
    }

    public function restoring(Product $product)
    {
        Cache::forget("products-count");
        foreach ($product->images as $image) {
            $image->restore();
        }
    }
}
