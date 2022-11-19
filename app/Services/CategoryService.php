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

    public function parentCategories()
    {
        return $this->categoryRepository->parentCategories();
    }

    public function count()
    {
        return $this->categoryRepository->count();
    }

    public function store(array $data)
    {
        $category = $this->category->create($data);
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('categories');
            $category->image()->save(
                $this->image->make(['path' => $path])
            );
        }

        if (isset($data['parent_category'])) {
            $parent_category = $this->category->find($data['parent_category']);
            if ($parent_category) {
                $category->parent()->associate($parent_category)->save();
            }
        }

        return $category;
    }

    public function update(array $data, Category $category)
    {
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('categories');
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

        if (isset($data['parent_category']) && !empty($data['parent_category']) && !is_null($category->parent_category_id)) {
            $parent_category = $this->category->find($data['parent_category']);
            if ($parent_category) {
                $category->parent_category_id = $parent_category->id;
                $category->save();
            }
        } else {
            $category->parent_category_id = null;
            $category->save();
        }
        
        if (!$category->isDirty()) {
            // return redirect()->back()->with('alert-info', 'You need to specify a different value to update');
        }

        $category->update($data);

        return $category;
    }

    public function delete(Category $category)
    {
        // Storage::delete($category->image->path);
        $category->delete();
    }
}
