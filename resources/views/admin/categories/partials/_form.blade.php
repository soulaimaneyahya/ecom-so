<div class="mb-3">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name ?? '') }}" placeholder="Category Name (Exp: Cosmetics) .." required autocomplete="name" autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="description">{{ __('Description') }}</label>
    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description Description .." autocomplete="description" required autofocus>{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="card p-3">
    <label for="image" class="form-label">Attache Image</label>
    <input class="form-control @error('image') is-invalid @enderror" 
    name="image" wire:model="image"
    accept="image/png, image/gif, image/svg, image/jpg, image/jpeg" type="file" id="image" />
    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

