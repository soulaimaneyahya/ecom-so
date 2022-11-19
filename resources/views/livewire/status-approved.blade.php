<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="{{ $review->id }}" 
    wire:change="approved('{{ $review->id }}')" @if($review->status === "approved") checked @endif>
</div>
