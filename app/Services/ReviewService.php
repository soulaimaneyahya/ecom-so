<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Review;
use App\Models\Product;
use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Storage;

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
        return $this->reviewRepository->count();
    }

    public function store(array $data)
    {
        $review = $this->review->create($data);
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $path = $image->store('reviews');
                    $review->images()->save(
                        $this->image->make(['path' => $path])
                    );
                }
            }
        }
        return $review;
    }

    public function update(array $data, Review $review)
    {
        if (isset($data['images'])) {
            if ($review->images) {
                foreach ($review->images as $image) {
                    Storage::delete($image->path);
                    $image->delete();
                }
            }
            foreach ($data['images'] as $image) {
                if ($image instanceof \Illuminate\Http\UploadedFile) {
                    $path = $image->store('reviews');
                    $review->images()->save(
                        $this->image->make(['path' => $path])
                    );
                }
            }
        }
        if ($review->isClean()) {
            // return redirect()->back()->with('alert-info', 'You need to specify a different value to update');
        }
        $review->update($data);
        return $review;
    }

    public function delete(Review $review)
    {
        foreach ($review->images as $image) {
            // Storage::delete($image->path);
        }
        $review->delete();
    }
}
