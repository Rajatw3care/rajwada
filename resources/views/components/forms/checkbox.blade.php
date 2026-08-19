@props([
    'label' => null,
    'name',
    'checked' => false,
])

<label class="flex items-center gap-2 cursor-pointer select-none">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        value="1"
        @checked(old($name, $checked))
        {{ $attributes->merge(['class' => 'h-4 w-4 rounded border-gray-300 text-brand-500 focus:ring-brand-500 dark:border-gray-700 dark:bg-gray-900']) }}
    />
    @if ($label)
        <span class="text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}</span>
    @endif
</label>
