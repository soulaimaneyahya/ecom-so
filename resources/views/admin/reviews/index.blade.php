@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12 px-0 mb-3">
      <div class="d-flex justify-content-between">
        <h4 class="fw-bold">{{ __('Products Reviews') }} <span class="text-primary">({{ $reviews_count }})</span></h4>
      </div>
    </div>
    <div class="card col-md-12">
      <div class="d-flex align-items-center justify-content-start my-3">
        <form class="d-flex form-inline w-100 my-lg-0" method="GET">
          <input class="form-control w-75 me-2" type="search" name="q" placeholder="Search for reviews .." @if(request('q')) value="{{ request('q') }}" @endif aria-label="Search">
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

        @sorted(['name' => 'status'])
          <option value disabled {{ request('sort') === null ? 'selected' : '' }}>Status</option>
          <option value="rejected" @if(request('status') == 'rejected') selected @endif>Rejected</option>
          <option value="approved" @if(request('status') == 'approved') selected @endif>Approved</option>
        @endsorted

        @if (request('q') || request('status'))
          <a class="btn btn-dark mx-2" href="{{ route('admin.reviews.index') }}">
            Clear
          </a>
        @endif
      </div>

       <div class="mt-3">
        <table class="table">
            <thead>
              <tr class="fw-bold">
                <th scope="col"></th>
                <th scope="col">{{ __('Rating') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Product') }}</th>
                <th scope="col">{{ __('Created') }}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($reviews as $review)
              @include('admin.reviews.partials._review')
              @empty
              <tr>
                <td colspan="8">
                  <h3> <img src="{{asset('assets/img/svg/void.svg')}}" class="my-4 mx-auto d-block" width="250" alt=""> </h3>
                  <h4 class="text-center fw-bold text-secondary">Add and manage your reviews</h4>
                  <p class="text-center fw-bold text-secondary">This is where you’ll add reviews and manage your pricing</p>
                  <div class="my-2 d-flex justify-content-center">
                    <a href="{{ route('admin.reviews.create') }}" class="btn btn-dark">{{ __('Add a Review') }}</a>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-2">
            {{ $reviews->links() }}
          </div>
       </div>
    </div>
</div>

@if($reviews->count())
@footer(['text' => 'Add a Review', 'route' => route('admin.reviews.create')])
@endfooter
@endif
@endsection
