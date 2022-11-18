<form method="GET" class="ms-2">
    <select class="form-select" id="{{ $name }}" name="{{ $name }}" onchange="this.form.submit()">
        {{ $slot }}
        @if (isset($timestamp) && $timestamp)
        <option value="asc" @if(request('sort_price') == 'asc') selected @endif>Created (Oldest First)</option>
        <option value="desc" @if(request('sort_price') == 'desc') selected @endif>Created (Newest First)</option>

        <option value="asc" @if(request('sort_price') == 'asc') selected @endif>Updated (Oldest First)</option>
        <option value="desc" @if(request('sort_price') == 'desc') selected @endif>Updated (Newest First)</option>
        @endif
    </select>
</form>
