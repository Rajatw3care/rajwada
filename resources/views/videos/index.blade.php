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
                    this.$nextTick(() => { if (window.setupVideoFormValidation) window.setupVideoFormValidation(); });
                })
                .catch(() => { this.modalLoading = false; this.modalHtml = '<p class=&quot;p-6 text-red-600&quot;>Failed to load form.</p>'; });
        }
    }">
        <x-common.page-breadcrumb pageTitle="Videos" subtitle="Manage videos for the Gallery and Testimonials pages" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('videos.create') }}" label="Add Video" @click.prevent="openModal('{{ route('videos.create') }}')" />
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($videos as $video)
                    <div class="grid-card-royal group">
                        <div class="h-1 w-full bg-gradient-to-r from-gold-300 via-brand-500 to-gold-300 opacity-70 transition group-hover:opacity-100"></div>

                        <div class="relative aspect-video w-full overflow-hidden bg-brand-50 dark:bg-white/5">
                            @if ($video->thumbnail)
                                <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="" class="h-full w-full object-cover">
                            @endif
                            <span class="absolute left-2 top-2 rounded-full bg-brand-700/90 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-gold-100">{{ $video->category === 'testimonial' ? 'Testimonial' : 'Gallery' }}</span>
                            @if ($video->duration)
                                <span class="absolute bottom-2 right-2 rounded bg-black/70 px-2 py-0.5 text-[11px] font-medium text-white">{{ $video->duration }}</span>
                            @endif
                        </div>

                        <div class="flex flex-1 flex-col gap-1.5 px-5 pb-2 pt-4">
                            <h3 class="line-clamp-1 font-display text-base font-semibold text-gray-800 dark:text-white/90">{{ $video->title }}</h3>
                            @if ($video->tag)
                                <p class="text-xs text-gold-500">{{ $video->tag }}</p>
                            @endif
                        </div>

                        <div class="mt-auto flex items-center justify-between gap-2 border-t border-gold-300/15 bg-gradient-to-r from-brand-50/60 via-transparent to-brand-50/60 px-5 py-3 dark:from-white/[0.02] dark:to-white/[0.02]">
                            <div class="flex items-center gap-2">
                                <x-ui.status-badge :active="$video->is_active" />
                                <span class="text-xs text-gray-400">#{{ $video->sort_order }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <x-ui.btn-edit href="{{ route('videos.edit', $video) }}" @click.prevent="openModal('{{ route('videos.edit', $video) }}')" />
                                <x-ui.btn-delete :action="route('videos.destroy', $video)" confirm="Delete this video? This cannot be undone." />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                        No videos yet &mdash; add your first one above.
                    </div>
                @endforelse
            </div>

            @if ($videos->hasPages())
                <div class="mt-4">{{ $videos->links() }}</div>
            @endif
        </div>

        <x-ui.crud-modal />
    </div>

    @push('scripts')
        <script src="{{ asset('js/video-validation.js') }}"></script>
    @endpush
@endsection
