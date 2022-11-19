<form method="GET" class="ms-2">
    <select class="form-select" id="{{ $name }}" name="{{ $name }}" onchange="this.form.submit()">
        {{ $slot }}
        @if (isset($timestamp) && $timestamp)
        <option value="created_at-asc" @if(request('sort') == 'created_at-asc') selected @endif>Created (Oldest First)</option>
        <option value="created_at-desc" @if(request('sort') == 'created_at-desc') selected @endif>Created (Newest First)</option>

        <option value="updated_at-asc" @if(request('sort') == 'updated_at-asc') selected @endif>Updated (Oldest First)</option>
        <option value="updated_at-desc" @if(request('sort') == 'updated_at-desc') selected @endif>Updated (Newest First)</option>
        @endif
    </select>
</form>
