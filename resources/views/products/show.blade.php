@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex align-items-start">
                <h4 class="fw-bold">{{ $product->name }}</h4>
                @badge(['type' => 'danger', 'show' => now()->diffInMinutes($product->created_at) < 5])
                 new !
                @endbadge
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <div class="d-flex align-items-start justify-content-between">
            <div class="col-md-8 ps-0">
                <p>{!! $product->description !!}</p>
                <p class="mt-4 text-muted">Added {{ $product->created_at->diffForHumans(); }}</p>
            </div>
            <div class="col-md-4 pe-0">
                <img src="{{ count($product->images) ? $product->images[0]->url() : asset('assets/img/product-default.png') }}" class="img-thumbnail" alt="{{ $product->name }}">
            </div>
        </div>
    </div>
</div>
@endsection
