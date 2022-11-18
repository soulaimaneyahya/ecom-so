<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    // saving, it's before creating & updating
    public function saving(Category $category)
    {
        Cache::forget("category-count");
        $category->slug = Str::slug($category->slug);
    }
    
    public function deleting(Category $category)
    {
        Cache::forget("category-count");
        $category->image->delete();
    }

    public function restoring(Category $category)
    {
        Cache::forget("category-count");
        $category->image->restore();
    }
}
