@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-12 px-0 mb-3">
    <div class="d-flex justify-content-between">
      <h4 class="fw-bold">{{ __('Categories') }} <span class="text-primary">({{ $categoriesCount }})</span></h4>
    </div>
  </div>
    <div class="card col-md-12">
      <div class="d-flex align-items-center justify-content-start my-3">
        <form class="d-flex form-inline w-100 my-lg-0" method="GET">
          <input class="form-control w-75 me-2" type="search" name="q" placeholder="Search for categories .." @if(request('q')) value="{{ request('q') }}" @endif aria-label="Search">
          <button class="btn btn-dark" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </form>
        
        @sorted(['name' => 'per_page'])
          <option value="5" @if(request('per_page') == 5) selected @endif>5</option>
          <option value="10" @if(request('per_page') == 10) selected @endif>10</option>
          <option value="15" @if(request('per_page') == 15) selected @endif>15</option>
          <option value="20" @if(request('per_page') == 20) selected @endif>20</option>
        @endsorted

        @sorted(['name' => 'sort', 'timestamp' => TRUE])
          <option selected>Sort</option>
          <option value="asc" @if(request('sort_price') == 'asc') selected @endif>Category Title A-Z</option>
          <option value="desc" @if(request('sort_price') == 'desc') selected @endif>Category Title Z-A</option>
        @endsorted

        @if (request('q') || request('sort'))
          <a class="btn btn-dark mx-2" href="{{ route('admin.categories.index') }}">
            Clear
          </a>
        @endif
      </div>

       <div class="mt-3">
        <table class="table m-0 p-0">
            <thead>
              <tr class="fw-bold">
                <th scope="col" class="column-collapse"></th>
                <th scope="col" class="column-collapse"></th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('has Products') }}</th>
                <th scope="col">{{ __('Created') }}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($categories as $category)
              @include('admin.categories.partials._category')
              @empty
              <tr>
                <td colspan="6">
                  <h3> <img src="{{asset('assets/img/svg/void.svg')}}" class="my-4 mx-auto d-block" width="250" alt=""> </h3>
                  <h4 class="text-center fw-bold text-secondary">Add and manage your categories</h4>
                  <p class="text-center fw-bold text-secondary">This is where you’ll add categories and manage your pricing</p>
                  <div class="my-2 d-flex justify-content-center">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-dark">{{ __('Add a Category') }}</a>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-2">
            {{ $categories->links() }}
          </div>
       </div>
    </div>
</div>
@if($categories->count())
@footer(['text' => 'Add a Category', 'route' => route('admin.categories.create')])
@endfooter
@endif
@endsection
