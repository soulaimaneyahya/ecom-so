<tr>
    <td class="column-sm category-parent-toggle" data-id="{{ $category->id }}" role="button">
        <svg id="category-caret-bottom-{{ $category->id }}" style="width: 20px !important" class="m-0 c-sidebar-nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-bottom') }}"></use>
        </svg>
        <svg id="category-caret-top-{{ $category->id }}" style="width: 20px !important" class="m-0 c-sidebar-nav-icon d-none">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-caret-top') }}"></use>
        </svg>
    </td>
    <td class="column-md">
        <img src="{{ $category->image ? $category->image->url() : asset('assets/img/image-not-available.png') }}" style="width: 70px; height: 70px; object-fit: cover;" class="img-fluid" alt="{{ $category->name }}">
    </td>
    <td class="column-xl">
        {{ $category->name }}
        @badge(['type' => 'danger', 'show' => now()->diffInMinutes($category->created_at) < 5])
        new !
        @endbadge
    </td>
    <td class="column-lg">{{ $category->products_count }}</td>
    <td class="column-lg">{{ $category->created_at->diffForHumans() }}</td>
    <td class="column-lg" align="right">
        <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-dark" title="view">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
        </svg>                    
        </a>
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-dark">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
        </svg>                    
        </a>
        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-dark" type="submit" title="delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>                    
            </button>
        </form>
    </td>
</tr>
<tr class="p-0 m-0 d-none" id="category-parent-{{ $category->id }}">
    @if (count($category->subcategories))
    <td colspan="6" class="p-0 m-0">
        <table class="table p-0 m-0">
            <tbody>
                @foreach ($category->subcategories as $subcategory)
                <tr>
                    <td class="column-sm"></td>
                    <td class="column-md">
                        <img src="{{ $subcategory->image ? $subcategory->image->url() : asset('assets/img/image-not-available.png') }}" style="width: 70px; height: 70px; object-fit: cover;" class="img-fluid" alt="{{ $subcategory->name }}">
                    </td>
                    <td class="column-xl">
                        {{ $subcategory->name }}
                        @badge(['type' => 'danger', 'show' => now()->diffInMinutes($subcategory->created_at) < 5])
                        new !
                        @endbadge
                    </td>
                    <td  class="column-lg">0</td>
                    <td  class="column-lg">{{ $subcategory->created_at->diffForHumans() }}</td>
                    <td  class="column-lg" align="right">
                        <a href="{{ route('admin.categories.show', $subcategory) }}" class="btn btn-sm btn-dark" title="view">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                        </svg>                    
                        </a>
                        <a href="{{ route('admin.categories.edit', $subcategory) }}" class="btn btn-sm btn-dark">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>                    
                        </a>
                        <form action="{{ route('admin.categories.destroy', $subcategory) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-dark" type="submit" title="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>                    
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </td>
    @else
    <td colspan="6" class="py-3 text-center">
        <strong>This category hasn’t subcategories</strong>
    </td>
    @endif
</tr>
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(function(){
        $('.category-parent-toggle').click(function() {
            $('#category-parent-' + $(this).data('id')).toggleClass('d-none');
            $('#category-caret-bottom-' + $(this).data('id')).toggleClass('d-none');
            $('#category-caret-top-' + $(this).data('id')).toggleClass('d-none');
        });
    })
</script>    
@endsection
