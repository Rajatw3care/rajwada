@props([
    'label' => null,
    'name',
    'current' => null,
    'required' => false,
])

@if ($label)
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
        {{ $label }}
    </label>
@endif

@if ($current)
    <img src="{{ asset('storage/'.$current) }}" alt="" class="mb-2 h-16 w-16 rounded-lg object-cover border border-gray-200 dark:border-gray-700">
@endif

<input
    type="file"
    id="{{ $name }}"
    name="{{ $name }}"
    accept="image/*"
    @if($required && !$current) required @endif
    {{ $attributes->merge(['class' => 'w-full rounded-lg border border-gray-300 bg-transparent text-sm text-gray-800 file:mr-4 file:rounded-lg file:border-0 file:bg-brand-50 file:px-4 file:py-2.5 file:text-sm file:font-medium file:text-brand-600 hover:file:bg-brand-100 dark:border-gray-700 dark:text-white/90 dark:file:bg-gray-800 dark:file:text-gray-300']) }}
/>

@error($name)
    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
@enderror
