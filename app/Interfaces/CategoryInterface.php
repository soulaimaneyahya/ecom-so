<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryInterface
{
    public function all();

    public function find(Category $category);
}
