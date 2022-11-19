<div class="d-flex justify-content-between align-items-start mb-3">
    <div class="w-full w-100">
        <label for="first_name">{{ __('First Name') }}</label>
        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" maxlength="191" name="first_name" value="{{ old('first_name', $review->first_name ?? '') }}" placeholder="First Name" required autocomplete="first_name" autofocus>
        @error('first_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="w-full w-100 mx-4">
        <label for="last_name">{{ __('Last Name') }}</label>
        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" maxlength="191" name="last_name" value="{{ old('last_name', $review->last_name ?? '') }}" placeholder="Last Name" required autocomplete="last_name" autofocus>
        @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="w-full w-100">
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" maxlength="255" value="{{ old('email', $review->email ?? '') }}" placeholder="Customer email" required autocomplete="email" autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="d-flex justify-content-between align-items-start mb-3">
    @if(!isset($review))
    <div class="w-full w-100 me-4">
        <label for="product_id">{{ __('Select Product') }}</label>
        <select class="form-control @error('product_id') is-invalid @enderror" name="product_id" id="product_id" required>
            <option value disabled {{ old('product_id', null) === null ? 'selected' : '' }}>Select Product</option>
            @foreach ($products as $product)
              <option 
              {{ old('product_id') == $product ? "selected" : "" }}
              {{ isset($review) && $review->product_id ? "selected" : "" }}
              value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        @error('product_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    @endif
    <div class="w-full w-100">
        <label for="rating">{{ __('Rating') }}</label>
        <input id="rating" type="number" min="1" max="5" class="form-control @error('rating') is-invalid @enderror" name="rating" value="{{ old('rating', $review->rating ?? '') }}" placeholder="Product rating" autocomplete="rating" required autofocus>
        @error('rating')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="description">{{ __('Description') }}</label>
    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description Description .." autocomplete="description" maxlength="600" required autofocus>{{ old('description', $review->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@isset($review)
@images(['title' => 'Review images'])
@foreach($review->images as $image)
    <img src="{{ $image->url() }}" style="width:200px; height:200px; object-fit: cover;" class="img-fluid" alt="no-image">
@endforeach
@endimages
@endisset

@livewire('upload-images-component')
