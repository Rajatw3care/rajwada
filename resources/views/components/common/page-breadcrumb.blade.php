@props(['pageTitle' => 'Page', 'subtitle' => null])

@unless (request()->boolean('modal'))
<div class="flex flex-wrap items-start justify-between gap-3 mb-6">
    <div>
        <h2 class="font-display text-2xl font-semibold text-brand-700 dark:text-gold-200">
            {{ $pageTitle }}
        </h2>
        @if ($subtitle)
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $subtitle }}</p>
        @endif
    </div>
    <nav>
        <ol class="flex items-center gap-2 text-sm">
            <li>
                <a class="inline-flex items-center gap-1.5 text-gray-500 hover:text-brand-600 dark:text-gray-400 dark:hover:text-gold-300" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="text-gold-400">&rsaquo;</li>
            <li class="text-gray-500 dark:text-gray-400">Site Content</li>
            <li class="text-gold-400">&rsaquo;</li>
            <li class="font-medium text-brand-700 dark:text-gold-200">{{ $pageTitle }}</li>
        </ol>
    </nav>
</div>
@endunless
