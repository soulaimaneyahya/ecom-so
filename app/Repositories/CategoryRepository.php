<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryInterface;

class CategoryRepository implements CategoryInterface
{
    public function __construct(
        private Category $category,
    ) {
    }

    public function all()
    {
        $per_page = request('per_page') ?? 5;
        $q = request('q');
        $sort = request('sort');

        $categories = $this->category
        ->with(['image', 'subcategories', 'subcategories.image'])
        ->whereNull('parent_category_id')
        ->select(['id', 'name', 'slug', 'created_at'])
        ->withCount('products');
        
        if ($q) {
            $categories = $categories->where('name', 'like', '%'. $q .'%');
        }
        if ($sort && in_array($sort, ["asc", "desc"])) {
            $categories = $categories->orderBy('name', $sort);
        } else {
            $categories = $categories->latest();
        }
        return $categories
        ->paginate($per_page) // page = 1
        ->appends([
            'per_page' => $per_page, // &per_page=10
            'q' => $q, // &q=lorem
            'sort' => $sort, // &sort=desc
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

    public function parent_categories()
    {
        return $this->category->whereNull('parent_category_id')->get(['id', 'name']);
    }
}
