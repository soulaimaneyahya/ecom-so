@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h4 class="fw-bold">{{ __('Create Category') }}</h4>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark btn-sm">{{ __('Back') }}</a>
        </div>
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.categories.partials._form')
            <button type="submit" class="btn btn-sm btn-dark">
                {{ __('Save') }}
            </button>
        </form>
    </div>
</div>
@endsection
