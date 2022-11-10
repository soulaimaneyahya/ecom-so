<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <label for="images" class="form-label">Attache Images</label>
                <input class="form-control @error('images') is-invalid @enderror" 
                @if (request()->routeIs('admin.products.create')) name="images[]" @else name="images" @endif wire:model="images"
                accept="image/png, image/gif, image/svg, image/jpg, image/jpeg" type="file" id="images"
                @if (request()->routeIs('admin.products.create')) multiple @endif/>
                @error('images')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($images)
                <div class="card p-3">
                    <div class="d-flex flex-wrap justify-content-start gap-3">
                        @foreach($images as $image)
                            <img src="{{ $image->temporaryUrl() }}" style="width:200px; height:200px; object-fit: cover;" class="img-fluid" alt="no-image">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>