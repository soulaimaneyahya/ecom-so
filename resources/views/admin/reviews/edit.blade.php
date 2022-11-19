@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold">{{ __('Edit Review') }}</h4>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.reviews.partials._form')
            @footer(['text' => 'Update'])
            @endfooter
        </form>
    </div>
</div>
@endsection
@section('scripts')
@include('partials.ckeditor')
@endsection