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
                .then(html => { this.modalHtml = html; this.modalLoading = false; })
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

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($services as $service)
                    <div class="grid-card-royal group">
                        <div class="flex items-start gap-4 p-5">
                            <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl border-2 border-gold-300/50 bg-brand-50 shadow-theme-xs dark:bg-white/5">
                                @if ($service->icon)
                                    <img src="{{ asset('storage/'.$service->icon) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="text-brand-300" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z" fill="currentColor"/></svg>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="truncate font-display text-base font-semibold text-gray-800 dark:text-white/90">{{ $service->title }}</h3>
                                <p class="mt-1 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">{{ $service->description }}</p>
                            </div>
                        </div>

                        <div class="mt-auto flex items-center justify-between gap-2 border-t border-gold-300/15 bg-brand-50/30 px-5 py-3 dark:bg-white/[0.02]">
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
@endsection
