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
                    this.$nextTick(() => { if (window.setupServiceFormValidation) window.setupServiceFormValidation(); });
                })
                .catch(() => { this.modalLoading = false; this.modalHtml = '<p class=&quot;p-6 text-red-600&quot;>Failed to load form.</p>'; });
        }
    }">
        <x-common.page-breadcrumb pageTitle="Services" subtitle="Manage the royal experiences offered by Rajwada Events" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('services.create') }}" label="Add Service" @click.prevent="openModal('{{ route('services.create') }}')" />
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($services as $service)
                    <div class="grid-card-royal group">
                        <div class="h-1 w-full bg-gradient-to-r from-gold-300 via-brand-500 to-gold-300 opacity-70 transition group-hover:opacity-100"></div>

                        <svg class="pointer-events-none absolute right-4 top-5 h-5 w-5 text-gold-300/40" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z"/></svg>

                        <div class="flex flex-1 flex-col items-center gap-3 px-6 pb-2 pt-7 text-center">
                            <div class="relative flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-br from-brand-50 to-gold-50 shadow-[0_6px_18px_-6px_rgba(216,178,94,0.5)] ring-2 ring-gold-300/60 transition duration-200 group-hover:ring-gold-400 dark:from-white/5 dark:to-white/5">
                                @if ($service->icon)
                                    <img src="{{ asset('storage/'.$service->icon) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="text-brand-300" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z" fill="currentColor"/></svg>
                                @endif
                            </div>

                            <h3 class="font-display text-lg font-semibold text-gray-800 dark:text-white/90">{{ $service->title }}</h3>

                            <svg class="h-2.5 w-28 text-gold-400/70" viewBox="0 0 120 10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <line x1="0" y1="5" x2="46" y2="5" stroke="currentColor" stroke-width=".9"/>
                                <line x1="74" y1="5" x2="120" y2="5" stroke="currentColor" stroke-width=".9"/>
                                <circle cx="60" cy="5" r="3" fill="currentColor"/>
                                <circle cx="52" cy="5" r="2" fill="currentColor"/>
                                <circle cx="68" cy="5" r="2" fill="currentColor"/>
                            </svg>

                            <p class="line-clamp-2 text-sm text-gray-500 dark:text-gray-400">{{ $service->description }}</p>
                        </div>

                        <div class="mt-auto flex items-center justify-between gap-2 border-t border-gold-300/15 bg-gradient-to-r from-brand-50/60 via-transparent to-brand-50/60 px-5 py-3 dark:from-white/[0.02] dark:to-white/[0.02]">
                            <div class="flex items-center gap-2">
                                <x-ui.status-badge :active="$service->is_active" />
                                <span class="text-xs text-gray-400">#{{ $service->sort_order }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-ui.btn-edit href="{{ route('services.edit', $service) }}" @click.prevent="openModal('{{ route('services.edit', $service) }}')" />
                                <x-ui.btn-delete :action="route('services.destroy', $service)" confirm="Delete this service? This cannot be undone." />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                        No services yet &mdash; add your first one above.
                    </div>
                @endforelse
            </div>

            @if ($services->hasPages())
                <div class="mt-4">{{ $services->links() }}</div>
            @endif
        </div>

        <x-ui.crud-modal />
    </div>

    @push('scripts')
        <script src="{{ asset('js/service-validation.js') }}"></script>
    @endpush
@endsection
