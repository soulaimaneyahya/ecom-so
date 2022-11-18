@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold">{{ __('Edit Product') }}</h4>
            <a href="{{ route('admin.products.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products.partials._form')
            @footer(['text' => 'Update'])
            @endfooter
        </form>
    </div>
</div>
@endsection
@section('scripts')
@include('partials.ckeditor')
@endsection