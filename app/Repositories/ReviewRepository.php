<?php

namespace App\Repositories;

use App\Models\Review;
use App\Interfaces\ReviewInterface;

class ReviewRepository implements ReviewInterface
{
    public $q;
    public $per_page;
    public $status;

    public function __construct(
        private Review $review,
    ) {
        $this->q = request('q');
        $this->per_page = request('per_page') ?? 5;
        $this->status = request('status');
    }
    
    public function all()
    {
        $reviews = $this->review
        ->with(['images', 'product'])
        ->select(['id', 'first_name', 'last_name', 'email', 'rating', 'status', 'created_at', 'product_id']);

        if ($this->q) {
            $reviews = $reviews
            ->where('first_name', 'like', "%{$this->q}%")
            ->orWhere('last_name', 'like', "%{$this->q}%")
            ->orWhere('email', 'like', "%{$this->q}%");
        }

        if ($this->status && in_array($this->status, ["rejected", "approved"])) {
            if ($this->status === "rejected") {
                $reviews = $reviews->where('status', $this->status);
            } elseif ($this->status === "approved") {
                $reviews = $reviews->where('status', $this->status);
            }
        } else {
            $reviews = $reviews->latest();
        }

        return $reviews
        ->paginate($this->per_page) // page = 1 ......
        ->appends([
            'per_page' => $this->per_page, // &per_page=10
            'q' => $this->q, // &q=lorem
            'status' => $this->status, // &status=approved
        ]);
    }

    public function count()
    {
        return $this->review->get(['id'])->count();
    }
}
