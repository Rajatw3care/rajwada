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
        <x-common.page-breadcrumb pageTitle="Ratings & Recognition" subtitle="Stat cards shown on the Testimonials page" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('rating-stats.create') }}" label="Add Rating Stat" @click.prevent="openModal('{{ route('rating-stats.create') }}')" />
            </div>

            <div class="card-royal overflow-hidden">
                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <table class="w-full min-w-[600px]">
                        <thead class="table-header-royal">
                            <tr>
                                <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Icon</p></th>
                                <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Number</p></th>
                                <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Label</p></th>
                                <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Order</p></th>
                                <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Actions</p></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ratingStats as $stat)
                                <tr class="border-b border-gold-300/10 transition hover:bg-brand-50/40 dark:hover:bg-white/[0.02]">
                                    <td class="px-5 py-4 sm:px-6 text-xl">{{ $stat->icon }}</td>
                                    <td class="px-5 py-4 sm:px-6"><p class="font-semibold text-gray-700 text-theme-sm dark:text-gray-300">{{ $stat->number }}</p></td>
                                    <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $stat->label }}</p></td>
                                    <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">#{{ $stat->sort_order }}</p></td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center gap-2">
                                            <x-ui.btn-edit href="{{ route('rating-stats.edit', $stat) }}" @click.prevent="openModal('{{ route('rating-stats.edit', $stat) }}')" />
                                            <x-ui.btn-delete :action="route('rating-stats.destroy', $stat)" confirm="Delete this rating stat?" />
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-5 py-8 text-center"><p class="text-gray-500 dark:text-gray-400">No rating stats yet.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <x-ui.crud-modal />
    </div>
@endsection
