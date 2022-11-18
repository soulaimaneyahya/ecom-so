<?php

namespace App\Observers;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class ReviewObserver
{
    /**
     * Handle the Review "creating" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function creating(Review $review)
    {
        Cache::forget("reviews-count");
    }

    /**
     * Handle the Order "deleting" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function deleting(Review $review)
    {
        Cache::forget("reviews-count");
    }

    /**
     * Handle the Review "restoring" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function restoring(Review $review)
    {
        Cache::forget("reviews-count");
    }
}
