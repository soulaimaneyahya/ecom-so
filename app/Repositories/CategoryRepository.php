<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    public $q;
    public $per_page;
    public $sort;

    public function __construct(
        private Category $category,
    ) {
        $this->q = request('q');
        $this->per_page = request('per_page') ?? 5;
        $this->sort = request('sort');
    }

    public function all()
    {
        $categories = $this->category
        ->with(['image', 'subcategories', 'subcategories.image'])
        ->whereNull('parent_category_id')
        ->select(['id', 'name', 'slug', 'created_at'])
        ->withCount('products');
        
        if ($this->q) {
            $categories = $categories->where('name', 'like', '%'. $this->q .'%');
        }

        if ($this->sort &&
            in_array($this->sort, [
            "name-asc", "name-desc", "products_count-asc", "products_count-desc", "created_at-asc",
            "created_at-desc", "updated_at-asc", "updated_at-desc"
        ])) {
            $request = explode("-", $this->sort);
            
            $field = $request[0];
            $value = $request[1];
            
            $categories = $categories->orderBy($field, $value);
        } else {
            $categories = $categories->latest();
        }


        return $categories
        ->paginate($this->per_page) // page = 1
        ->appends([
            'per_page' => $this->per_page, // &per_page=10
            'q' => $this->q, // &q=lorem
            'sort' => $this->sort, // &sort=desc
        ]);
    }

    public function find(Category $category)
    {
        return $category;
    }

    public function count()
    {
        return $this->category->whereNull('parent_category_id')->get(['id'])->count();
    }

    public function parentCategories()
    {
        return $this->category->whereNull('parent_category_id')->get(['id', 'name']);
    }
}
