<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <label for="images" class="form-label">Attache Images</label>
                <input class="form-control @error('images') is-invalid @enderror" 
                name="images[]" wire:model="images"
                accept="image/png, image/gif, image/svg, image/jpg, image/jpeg" type="file" id="images"
                required
                multiple/>
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
                @images(['title' => 'Preview images'])
                @foreach($images as $image)
                    <img src="{{ $image->temporaryUrl() }}" style="width:200px; height:200px; object-fit: cover;" class="img-fluid" alt="no-image">
                @endforeach
                @endimages
            @endif
        </div>
    </div>
</div>
