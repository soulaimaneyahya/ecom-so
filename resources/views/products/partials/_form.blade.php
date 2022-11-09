<div class="mb-3">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name ?? '') }}" placeholder="Product Name (Exp: T-shirt Black) .." required autocomplete="name" autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
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
<div class="mb-3">
    <label for="price">{{ __('Price') }}</label>
    <input id="price" type="number" min="1" step=".01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price ?? '') }}" placeholder="Price" required autocomplete="price" autofocus>
    @error('price')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
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
