@props(['href' => '#', 'label' => 'Add'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'btn-royal-add']) }}>
    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z"/>
    </svg>
    <span>{{ $label }}</span>
</a>
