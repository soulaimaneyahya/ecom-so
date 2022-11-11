<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private Product $product,
        private Category $category,
        private Image $image
    ) {
    }
    
    public function all()
    {
        return $this->productRepository->all();
    }

    public function find(Product $product)
    {
        return $this->productRepository->find($product);
    }

    public function store(array $data)
    {
        $product = $this->product->create($data);

        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $path = $image->store('products');
                    $product->images()->save(
                        $this->image->make(['path' => $path])
                    );
                }
            }
        }

        if (isset($data['category'])) {
            $category = $this->category->find($data['category']);
            $product->categories()->attach($category);
        }

        return $product;
    }

    public function update(array $data, Product $product)
    {
        $product->update($data);

        if (isset($data['images'])) {
            if ($product->images) {
                foreach ($product->images as $image) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
            foreach ($data['images'] as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $path = $image->store('products');
                    $product->images()->save(
                        $this->image->make(['path' => $path])
                    );
                }
            }
        }

        if (isset($data['category'])) {
            $category = $this->category->find($data['category']);
            if ($category) {
                $product->categories()->sync([]);
                $product->categories()->attach($category);
            }
        }

        return $product;
    }

    public function delete(Product $product)
    {
        foreach ($product->images as $image) {
            // Storage::delete($image->path);
        }
        $product->delete();
    }
}
