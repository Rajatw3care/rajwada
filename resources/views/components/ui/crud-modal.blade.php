<div
    x-show="modalOpen"
    x-cloak
    class="modal-overlay-royal"
    @click.self="modalOpen = false"
    @keydown.escape.window="modalOpen = false"
    @click="if ($event.target.closest('[data-modal-close]')) { $event.preventDefault(); modalOpen = false; }"
>
    <div class="modal-panel-royal" x-transition.opacity.duration.150ms>
        <button type="button" @click="modalOpen = false" aria-label="Close"
            class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full bg-white/90 text-gray-500 shadow-theme-xs transition hover:bg-white hover:text-brand-700 dark:bg-gray-800/90 dark:text-gray-300 dark:hover:text-gold-300">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <div x-show="modalLoading" class="flex items-center justify-center gap-2 p-16 text-sm text-gray-400">
            <svg class="h-4 w-4 animate-spin text-brand-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="3" opacity="0.25"/>
                <path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            </svg>
            Loading&hellip;
        </div>

        <div x-show="!modalLoading" x-html="modalHtml"></div>
    </div>
</div>
