@if (isset($show) && $show)
<span class="badge bg-{{ $type ?? 'danger' }} me-2">
    {{ $slot }}
</span>
@endif