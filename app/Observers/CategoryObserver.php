<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    // saving, it's before creating & updating
    public function saving(Category $category)
    {
        $category->slug = Str::slug($category->slug);
    }
    
    public function deleting(Category $category)
    {
        $category->image->delete();
    }

    public function restoring(Category $category)
    {
        $category->image->restore();
    }
}
