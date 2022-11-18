<div class="page-footer bg-white py-2 px-4 d-flex justify-content-end">
    @isset($route)
    <a href="{{ $route }}" class="btn btn-dark text-white">{{ $text }}</a>
    @else
    <button type="submit" class="btn btn-dark text-white">{{ $text }}</button>
    @endisset
</div>