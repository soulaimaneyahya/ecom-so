<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {
        $product = new Product();
        $product->id = 0;
        $product->exists = true;
        $image = $product->addMediaFromRequest('upload')->toMediaCollection('images');
        return response()->json([
            'url' => $image->getUrl(),
        ]);
    }
}
