<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Category;

class StoreCategoryController extends Controller
{
    public function show(Category $category)
    {
        dd($category);
    }
}
