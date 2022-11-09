@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
       <div class="d-flex justify-content-between">
        <h4 class="fw-bold">{{ __('Products') }}</h4>
        <a href="{{ route('products.create') }}" class="btn btn-dark btn-sm">{{ __('Create Product') }}</a>
       </div>

      <div class="d-flex align-items-center justify-content-start my-3">
        <form class="d-flex form-inline w-100 my-lg-0" method="GET">
          <input class="form-control w-75 me-2" type="search" name="q" placeholder="Search .." @if(request('q')) value="{{ request('q') }}" @endif aria-label="Search">
          <button class="btn btn-dark" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>              
          </button>
        </form>
        <form method="GET" class="ms-2">
          <select class="form-control" name="per_page" id="per_page" onchange="this.form.submit()">
              <option value="5" @if(request('per_page') == 5) selected @endif>5</option>
              <option value="10" @if(request('per_page') == 10) selected @endif>10</option>
              <option value="15" @if(request('per_page') == 15) selected @endif>15</option>
              <option value="20" @if(request('per_page') == 20) selected @endif>20</option>
          </select>
        </form>
        <form method="GET" class="ms-2">
          <select class="form-select" id="sort_price" name="sort_price" onchange="this.form.submit()">
            <option selected>Sort</option>
            <option value="desc" @if(request('sort_price') == 'desc') selected @endif>Desc</option>
            <option value="asc" @if(request('sort_price') == 'asc') selected @endif>Asc</option>
          </select>
        </form>
        @if (request('q') || request('sort_price'))
          <a class="btn btn-dark mx-2" href="{{ route('products.index') }}">
            Clear
          </a>
        @endif      
      </div>

       <div class="my-3">
        <table class="table">
            <thead>
              <tr class="fw-bold">
                <th scope="col"></th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Price') }}</th>
                <th scope="col">{{ __('Stock') }}</th>
                <th scope="col">{{ __('Created') }}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $product)
              @include('products.partials._product')
              @empty
              <tr>
                <td class="text-center fw-bold" colspan="6">{{ __('No Product Found') }}</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <div class="my-2">
            {{ $products->links() }}
          </div>
       </div>
    </div>
</div>
@endsection
