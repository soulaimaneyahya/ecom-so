<!-- Categories Start -->
<div class="container-fluid pt-3">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-12">
            <h3>Categories Most Products</h3>
        </div>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($categoriesMostProducts as $category)
        <div class="col-lg-3 col-md-6 pb-1">
            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                <p class="text-right">{{ $category->products_count }} Products</p>
                <a href="{{ route('store.categories.show', $category) }}" class="cat-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid" src="{{ $category->image ? $category->image->url() : asset('assets/img/image-not-available.png') }}" alt="{{ $category->name }}">
                </a>
                <h5 class="font-weight-semi-bold m-0">{{$category->name}}</h5>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Categories End -->