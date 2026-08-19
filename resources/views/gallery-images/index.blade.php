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
        <x-common.page-breadcrumb pageTitle="Gallery" subtitle="Photos shown in the public gallery grid" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('gallery-images.create') }}" label="Add Image" @click.prevent="openModal('{{ route('gallery-images.create') }}')" />
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-3 md:grid-cols-4">
                @forelse ($galleryImages as $image)
                    <div class="grid-card-royal group">
                        <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->alt_text }}" class="h-36 w-full object-cover">
                        <div class="flex flex-1 flex-col gap-2 p-4">
                            <p class="truncate text-sm font-medium text-gray-700 dark:text-gray-300" title="{{ $image->alt_text }}">{{ $image->alt_text ?: '—' }}</p>
                            <div class="flex items-center gap-2">
                                <x-ui.status-badge :active="$image->is_active" />
                                <span class="text-xs text-gray-400">#{{ $image->sort_order }}</span>
                            </div>
                            <div class="mt-auto flex items-center gap-2 pt-2">
                                <x-ui.btn-edit href="{{ route('gallery-images.edit', $image) }}" @click.prevent="openModal('{{ route('gallery-images.edit', $image) }}')" />
                                <x-ui.btn-delete :action="route('gallery-images.destroy', $image)" />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                        No gallery images yet &mdash; add your first one above.
                    </div>
                @endforelse
            </div>

            @if ($galleryImages->hasPages())
                <div class="mt-4">{{ $galleryImages->links() }}</div>
            @endif
        </div>

        <x-ui.crud-modal />
    </div>
@endsection
