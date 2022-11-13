<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    // saving, it's before creating & updating
    public function saving(Product $product)
    {
        $product->slug = Str::slug($product->slug);
    }

    public function deleting(Product $product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }

    public function restoring(Product $product)
    {
        foreach ($product->images as $image) {
            $image->restore();
        }
    }
}
