<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function deleting(Category $category)
    {
        $category->image->delete();
    }

    public function restoring(Category $category)
    {
        $category->image->restore();
    }
}
