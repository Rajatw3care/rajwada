@props(['active' => true, 'activeLabel' => 'Active', 'inactiveLabel' => 'Inactive'])

@if ($active)
    <span class="badge-royal-active">
        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
        {{ $activeLabel }}
    </span>
@else
    <span class="badge-royal-inactive">
        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
        {{ $inactiveLabel }}
    </span>
@endif
