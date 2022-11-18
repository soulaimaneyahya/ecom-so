<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\ReviewRepository;

class ReviewService
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
        return $this->reviewRepository->all();
    }

    public function count()
    {
        return $this->review->get(['id'])->count();
    }

    public function store(array $data)
    {
        $review = $this->review->create($data);
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('categories');
            $review->image()->save(
                $this->image->make(['path' => $path])
            );
        }

        return $review;
    }
}
