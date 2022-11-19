<?php

namespace App\Http\Livewire;

use App\Models\Review;
use Livewire\Component;

class StatusApproved extends Component
{
    public $review;

    public function render()
    {
        return view('livewire.status-approved');
    }

    public function approved($review_id)
    {
        $review = Review::find($review_id);
        if ($review) {
            switch ($review->status) {
                case 'approved':
                    $review->status = "rejected";
                    $review->update();
                    $this->review = $review;
                    break;
                case 'rejected':
                    $review->status = "approved";
                    $review->update();
                    $this->review = $review;
                    break;
                default:
                    $this->review = $review;
                    break;
            }
        }
    }
}
