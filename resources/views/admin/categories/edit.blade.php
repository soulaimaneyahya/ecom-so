@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold">{{ __('Edit Category') }}</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.categories.partials._form')
            @footer(['text' => 'Update'])
            @endfooter
        </form>
    </div>
</div>
@endsection
