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
                    this.$nextTick(() => { if (window.setupBlogPostFormValidation) window.setupBlogPostFormValidation(); });
                })
                .catch(() => { this.modalLoading = false; this.modalHtml = '<p class=&quot;p-6 text-red-600&quot;>Failed to load form.</p>'; });
        }
    }">
        <x-common.page-breadcrumb pageTitle="Blogs & Stories" subtitle="Wedding stories featured on the public site" />

        <div class="space-y-6">
            @session('success')
                <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
            @endsession

            <div class="flex justify-end">
                <x-ui.btn-add href="{{ route('blog-posts.create') }}" label="Add Post" @click.prevent="openModal('{{ route('blog-posts.create') }}')" />
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @forelse ($blogPosts as $post)
                    <div class="grid-card-royal group">
                        <div class="relative h-40 w-full overflow-hidden">
                            @if ($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                            @endif
                            <div class="absolute left-3 top-3">
                                <x-ui.status-badge :active="$post->is_active" active-label="Published" inactive-label="Draft" />
                            </div>
                        </div>
                        <div class="flex flex-1 flex-col gap-1.5 p-4">
                            <h3 class="line-clamp-2 font-display text-base font-semibold text-gray-800 dark:text-white/90">{{ $post->title }}</h3>
                            @if ($post->venue)
                                <p class="text-sm text-gold-600 dark:text-gold-400">{{ $post->venue }}</p>
                            @endif
                            <div class="mt-auto flex items-center gap-2 pt-3">
                                <x-ui.btn-edit href="{{ route('blog-posts.edit', $post) }}" @click.prevent="openModal('{{ route('blog-posts.edit', $post) }}')" />
                                <x-ui.btn-delete :action="route('blog-posts.destroy', $post)" confirm="Delete this post? This cannot be undone." />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">
                        No blog posts yet &mdash; add your first one above.
                    </div>
                @endforelse
            </div>

            @if ($blogPosts->hasPages())
                <div class="mt-4">{{ $blogPosts->links() }}</div>
            @endif
        </div>

        <x-ui.crud-modal />
    </div>

    @push('scripts')
        <script src="{{ asset('js/blog-post-validation.js') }}"></script>
    @endpush
@endsection
