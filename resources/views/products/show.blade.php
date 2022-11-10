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
                @if ($product->images)
                <img src="{{ $product->images[0]->url() ?? asset('assets/img/product-default.png') }}" style="width:500px; height:500px; object-fit: cover;" class="img-thumbnail" alt="{{ $product->name }}">
                <div class="d-flex flex-wrap justify-content-start gap-3 my-3">
                    @foreach($product->images as $image)
                        <img src="{{ $image->url() }}" style="width:100px; height:110px; object-fit: cover;" class="img-fluid" alt="no-image">
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
