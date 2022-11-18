<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Review;
use App\Models\Product;
use App\Interfaces\ReviewInterface;

class ReviewRepository extends ReviewInterface
{
    public function __construct
    (
        private ReviewRepository $reviewRepository,
        private Review $review,
        private Product $product,
        private Image $image,
    )
    {
    }
    
    public function all()
    {
        return $this->review->all();
    }
}
