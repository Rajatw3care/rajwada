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
        <x-common.page-breadcrumb pageTitle="Testimonials" subtitle="Client reviews shown in the homepage slider" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('testimonials.create') }}" label="Add Testimonial" @click.prevent="openModal('{{ route('testimonials.create') }}')" />
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($testimonials as $testimonial)
                    <div class="grid-card-royal group p-5">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full border-2 border-gold-300/50 bg-brand-50 dark:bg-white/5">
                                @if ($testimonial->avatar)
                                    <img src="{{ asset('storage/'.$testimonial->avatar) }}" alt="" class="h-full w-full object-cover">
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h3 class="truncate font-display text-sm font-semibold text-gray-800 dark:text-white/90">{{ $testimonial->name }}</h3>
                                <x-ui.status-badge :active="$testimonial->is_active" />
                            </div>
                        </div>
                        <p class="mt-3 line-clamp-3 text-sm text-gray-500 dark:text-gray-400">&ldquo;{{ $testimonial->message }}&rdquo;</p>
                        <div class="mt-4 flex items-center gap-2 border-t border-gold-300/15 pt-3">
                            <x-ui.btn-edit href="{{ route('testimonials.edit', $testimonial) }}" @click.prevent="openModal('{{ route('testimonials.edit', $testimonial) }}')" />
                            <x-ui.btn-delete :action="route('testimonials.destroy', $testimonial)" />
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                        No testimonials yet &mdash; add your first one above.
                    </div>
                @endforelse
            </div>

            @if ($testimonials->hasPages())
                <div class="mt-4">{{ $testimonials->links() }}</div>
            @endif
        </div>

        <x-ui.crud-modal />
    </div>
@endsection
