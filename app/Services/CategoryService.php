<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Image;
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

        return $category;
    }

    public function update(array $data, Category $category)
    {
        $category->update($data);

        return $category;
    }

    public function delete(Category $category)
    {
        // Storage::delete($category->image->path);
        $category->delete();
    }
}
