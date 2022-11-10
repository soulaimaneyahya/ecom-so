<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function restoring(Product $product)
    {
        foreach ($product->images as $image) {
            $image->restore();
        }
    }

    public function deleting(Product $product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }
}
