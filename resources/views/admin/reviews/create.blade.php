@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h4 class="fw-bold">{{ __('Create Review') }}</h4>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.reviews.partials._form')
            @footer(['text' => 'Save'])
            @endfooter
        </form>
    </div>
</div>
@endsection
@section('scripts')
@include('partials.ckeditor')
@endsection
