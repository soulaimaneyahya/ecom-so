<div class="mb-3">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" maxlength="191" value="{{ old('name', $product->name ?? '') }}" placeholder="Product Name (Exp: T-shirt Black) .." required autocomplete="name" autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="mb-3 form-group">
    <div class="form-control d-flex align-items-center justify-content-start">
        <span class="me-3">http://127.0.0.1:8000/store/products/</span>
        <input type="text" name="slug" id="slug" maxlength="191" class="form-control w-75 @error('slug') is-invalid  @enderror" 
        value="{{ old('slug', $product->slug ?? '') }}" placeholder="Slug .." required>
    </div>
    @error('slug')
        <p class="text-danger fw-bold">{{ $message }}</p>
    @enderror
</div>

<div class="mb-3">
    <label for="textarea-desc-ckeditor">{{ __('Description') }}</label>
    <textarea id="textarea-desc-ckeditor" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Product Description .." autocomplete="description" autofocus>{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="d-flex mb-3">
    <div class="me-4">
        <label for="price_before">{{ __('Price Before') }}</label>
        <input id="price_before" type="number" min="1" step=".01" class="form-control @error('price_before') is-invalid @enderror" name="price_before" value="{{ old('price_before', $product->price_before ?? '') }}" placeholder="Price Before" required autocomplete="price_before" autofocus>
        @error('price_before')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div>
        <label for="price">{{ __('Price') }}</label>
        <input id="price" type="number" min="1" step=".01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="Price" required autocomplete="price" autofocus>
        @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="stock">{{ __('Stock') }}</label>
    <input type="number" id="stock" min="1" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="Stock" required autocomplete="stock" autofocus value="{{ old('stock', $product->stock ?? '') }}" />
    @error('stock')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="category">{{ __('Choose Category') }}</label>
    <select class="form-control" name="category" id="category">
        <option value disabled {{ old('category', null) === null ? 'selected' : '' }}>Havn't Category</option>
        @foreach ($categories as $category)
          <option 
          {{ old('category') == $category ? "selected" : "" }}
          {{ isset($product) && $product->categories->contains($category->id) ? "selected" : "" }}
          value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>


@isset($product)
@images(['title' => 'Product images'])
@foreach($product->images as $image)
    <img src="{{ $image->url() }}" style="width:200px; height:200px; object-fit: cover;" class="img-fluid" alt="no-image">
@endforeach
@endimages
@endisset

@livewire('upload-images-component')
