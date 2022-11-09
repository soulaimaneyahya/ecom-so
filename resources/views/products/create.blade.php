@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h4 class="fw-bold">{{ __('Create Product') }}</h4>
            <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('products.partials._form')
            <button type="submit" class="btn btn-sm btn-dark">
                {{ __('Save') }}
            </button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@include('partials.ckeditor')
@endsection