<?php

namespace App\Services;

use App\Models\Review;

class ReviewService
{
    public function all()
    {
        return Review::paginate(5);
    }

    public function count()
    {
        return Review::get(['id'])->count();
    }
}
