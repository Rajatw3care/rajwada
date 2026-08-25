@extends('layouts.app')

@section('content')
    <div x-data="{
        modalOpen: false,
        modalHtml: '',
        modalLoading: false,
        openModal(url) {
            this.modalOpen = true;
            this.modalLoading = true;
            this.modalHtml = '';
            fetch(url + (url.includes('?') ? '&' : '?') + 'modal=1', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    this.modalHtml = html;
                    this.modalLoading = false;
                    // The modal's HTML is injected via x-html, so <script> tags in it
                    // never execute — call the validation setup manually once the
                    // form is actually in the DOM.
                    this.$nextTick(() => { if (window.setupDestinationFormValidation) window.setupDestinationFormValidation(); });
                })
                .catch(() => { this.modalLoading = false; this.modalHtml = '<p class=&quot;p-6 text-red-600&quot;>Failed to load form.</p>'; });
        }
    }">
        <x-common.page-breadcrumb pageTitle="Featured Destinations" subtitle="Manage destinations shown on the Success Story page" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('destinations.create') }}" label="Add Destination" @click.prevent="openModal('{{ route('destinations.create') }}')" />
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($destinations as $destination)
                    <div class="grid-card-royal group">
                        <div class="h-1 w-full bg-gradient-to-r from-gold-300 via-brand-500 to-gold-300 opacity-70 transition group-hover:opacity-100"></div>

                        <div class="relative aspect-[4/3] w-full overflow-hidden bg-brand-50 dark:bg-white/5">
                            <img src="{{ asset('storage/'.$destination->image) }}" alt="" class="h-full w-full object-cover">
                        </div>

                        <div class="flex flex-1 flex-col gap-1.5 px-5 pb-2 pt-4">
                            <h3 class="font-display text-base font-semibold text-gray-800 dark:text-white/90">{{ $destination->name }}</h3>
                            <p class="text-sm text-gold-500">{{ $destination->count_label }}</p>
                        </div>

                        <div class="mt-auto flex items-center justify-between gap-2 border-t border-gold-300/15 bg-gradient-to-r from-brand-50/60 via-transparent to-brand-50/60 px-5 py-3 dark:from-white/[0.02] dark:to-white/[0.02]">
                            <div class="flex items-center gap-2">
                                <x-ui.status-badge :active="$destination->is_active" />
                                <span class="text-xs text-gray-400">#{{ $destination->sort_order }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-ui.btn-edit href="{{ route('destinations.edit', $destination) }}" @click.prevent="openModal('{{ route('destinations.edit', $destination) }}')" />
                                <x-ui.btn-delete :action="route('destinations.destroy', $destination)" confirm="Delete this destination? This cannot be undone." />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                        No destinations yet &mdash; add your first one above.
                    </div>
                @endforelse
            </div>

            @if ($destinations->hasPages())
                <div class="mt-4">{{ $destinations->links() }}</div>
            @endif
        </div>

        <x-ui.crud-modal />
    </div>

    @push('scripts')
        <script src="{{ asset('js/destination-validation.js') }}"></script>
    @endpush
@endsection
