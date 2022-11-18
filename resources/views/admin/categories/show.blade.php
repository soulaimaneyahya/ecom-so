@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex align-items-start">
                <h4 class="fw-bold me-3">
                    @if ($category->parent) {{ $category->parent->name }} / @endif
                    {{ $category->name }}
                </h4>
                @badge(['type' => 'danger', 'show' => now()->diffInMinutes($category->created_at) < 5])
                 new !
                @endbadge
            </div>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <div class="d-flex align-items-start justify-content-between">
            <div class="col-md-8 ps-0">
                <p>{!! $category->description !!}</p>
                <p class="mt-4 text-muted">Added {{ $category->created_at->diffForHumans(); }}</p>
            </div>
            <div class="col-md-4 pe-0">
                <img src="{{ $category->image ? $category->image->url() : asset('assets/img/image-not-available.png') }}" style="width:500px; height:500px; object-fit: cover;" class="img-thumbnail" alt="{{ $category->name }}">
            </div>
        </div>
    </div>
</div>
@endsection
