<div class="mb-3">
    <label for="name">{{ __('Name') }}</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  maxlength="191" value="{{ old('name', $category->name ?? '') }}" placeholder="Category Name (Exp: Cosmetics) .." required autocomplete="name" autofocus>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="mb-3 form-group">
    <div class="form-control d-flex align-items-center justify-content-start">
        <span class="me-3">http://127.0.0.1:8000/store/categories/</span>
        <input type="text" name="slug" id="slug" maxlength="191" class="form-control w-75 @error('slug') is-invalid  @enderror" 
        value="{{ old('slug', $category->slug ?? '') }}" placeholder="Slug .." required>
    </div>
    @error('slug')
        <p class="text-danger fw-bold">{{ $message }}</p>
    @enderror
</div>


<div class="mb-3">
    <label for="description">{{ __('Description') }}</label>
    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description Description .." autocomplete="description" maxlength="600" required autofocus>{{ old('description', $category->description ?? '') }}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@if (!isset($category) || (isset($category) && !is_null($category->parent_category_id)))
<div class="mb-3">
    <label for="parent_category">{{ __('Choose Parent Category') }}</label>
    <select class="form-control" name="parent_category" id="parent_category">
        <option value disabled {{ old('parent_category', null) === null ? 'selected' : '' }}>Havn't Parent Category</option>
        @foreach ($parent_categories as $item)
          <option 
          {{ old('category') == $item ? "selected" : "" }}
          {{ isset($category) && $category->parent_category_id == $item->id ? "selected" : "" }}
          value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>
@endif

<div class="card p-3">
    <label for="image" class="form-label">Attache Image</label>
    <input class="form-control @error('image') is-invalid @enderror" 
    name="image" wire:model="image"
    accept="image/png, image/gif, image/svg, image/jpg, image/jpeg" type="file" id="image"/>
    @error('image')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@isset($category)
@images(['title' => 'Category image'])
<img src="{{ $category->image->url() }}" style="width:200px; height:200px; object-fit: cover;" class="img-fluid" alt="no-image">
@endimages
@endisset
