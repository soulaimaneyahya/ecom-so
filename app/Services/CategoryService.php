<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private Category $category,
        private Image $image
    ) {
    }
    
    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function find(Category $category)
    {
        return $this->categoryRepository->find($category);
    }

    public function store(array $data)
    {
        $category = $this->category->create($data);
        if(isset($data['images']) && $data['images'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['images']->store('categories');
            $category->image()->save(
                $this->image->make(['path' => $path])
            );
        }
        return $category;
    }

    public function update(array $data, Category $category)
    {
        $category->update($data);
        if(isset($data['images']) && $data['images'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['images']->store('categories');
            if ($category->image) {
                Storage::delete($category->image->path);
                $category->image->path = $path;
                $category->image->save();
            } else {
                $category->image()->save(
                    Image::make(['path' => $path])
                );
            }
        }
        return $category;
    }

    public function delete(Category $category)
    {
        // Storage::delete($category->image->path);
        $category->delete();
    }
}
