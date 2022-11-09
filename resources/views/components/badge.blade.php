@if (isset($show) && $show)
<span class="badge bg-{{ $type ?? 'danger' }} mx-2">
    {{ $slot }}
</span>
@endif