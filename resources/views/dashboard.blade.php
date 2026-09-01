@extends('layouts.app')

@section('content')
    @php
        use App\Helpers\MenuHelper;

        $cards = [
            ['label' => 'Services', 'value' => $stats['services'], 'href' => route('services.index'), 'icon' => 'task'],
            ['label' => 'Gallery Images', 'value' => $stats['gallery'], 'href' => route('gallery-images.index'), 'icon' => 'ui-elements'],
            ['label' => 'Blog Posts', 'value' => $stats['blogPosts'], 'href' => route('blog-posts.index'), 'icon' => 'pages'],
            ['label' => 'Testimonials', 'value' => $stats['testimonials'], 'href' => route('testimonials.index'), 'icon' => 'chat'],
            ['label' => 'Unread Messages', 'value' => $stats['unreadMessages'], 'href' => route('contact-messages.index'), 'icon' => 'email', 'highlight' => $stats['unreadMessages'] > 0],
            ['label' => 'Total Messages', 'value' => $stats['totalMessages'], 'href' => route('contact-messages.index'), 'icon' => 'email'],
        ];

        $quickActions = [
            ['label' => 'Add Service', 'href' => route('services.create'), 'icon' => 'task'],
            ['label' => 'Add Gallery Image', 'href' => route('gallery-images.create'), 'icon' => 'ui-elements'],
            ['label' => 'Add Blog Post', 'href' => route('blog-posts.create'), 'icon' => 'pages'],
            ['label' => 'Add Testimonial', 'href' => route('testimonials.create'), 'icon' => 'chat'],
            ['label' => 'Edit Homepage Hero', 'href' => route('hero.edit'), 'icon' => 'dashboard'],
            ['label' => 'Edit Website Settings', 'href' => route('settings.edit'), 'icon' => 'forms'],
        ];
    @endphp

    <div class="space-y-6">

        <!-- Welcome banner -->
        <div class="relative isolate overflow-hidden rounded-2xl shadow-theme-lg">
            <div class="absolute inset-0 bg-[url('/assets/bg-contact.webp')] bg-cover bg-[center_35%]"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-brand-950/90 via-brand-900/75 to-brand-950/35"></div>
            <div class="relative px-6 py-8 md:px-10 md:py-12">
                <p class="text-theme-xs uppercase tracking-[0.2em] text-gold-300/80">Rajwada Events Admin</p>
                <h2 class="mt-2 font-display text-2xl font-semibold text-white md:text-3xl">
                    Welcome back, {{ explode(' ', auth()->user()->name)[0] }}
                </h2>
                <p class="mt-2 max-w-xl text-sm text-white/70">
                    Everything you publish here goes live on the website instantly &mdash; no rebuild, no waiting.
                </p>
                <a href="{{ route('home') }}" target="_blank"
                    class="mt-5 inline-flex items-center gap-2 rounded-lg border border-gold-300/50 bg-white/10 px-5 py-2.5 text-sm font-medium text-gold-100 backdrop-blur-sm transition hover:bg-white/20 hover:text-white">
                    View live site
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 17L17 7M17 7H8M17 7V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($cards as $card)
                <a href="{{ $card['href'] }}" class="grid-card-royal group">
                    <div class="h-1 w-full bg-gradient-to-r from-gold-300 via-brand-500 to-gold-300 opacity-60 transition group-hover:opacity-100"></div>
                    <div class="relative p-5">
                        <svg class="pointer-events-none absolute -right-3 -top-1 h-20 w-20 text-brand-50 dark:text-white/[0.03]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z" fill="currentColor"/>
                        </svg>
                        <div class="relative flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br shadow-[0_6px_16px_-6px_rgba(163,32,43,0.5)] transition duration-200 group-hover:scale-105 {{ !empty($card['highlight']) ? 'from-brand-600 to-brand-800 text-gold-100' : 'from-brand-500 to-brand-700 text-gold-100' }}">
                            <span class="[&>svg]:h-5 [&>svg]:w-5">{!! MenuHelper::getIconSvg($card['icon']) !!}</span>
                        </div>
                        <div class="relative mt-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $card['label'] }}</span>
                            <h4 class="mt-1 font-display text-2xl font-semibold text-gray-800 dark:text-white/90">{{ $card['value'] }}</h4>
                            @if (!empty($card['highlight']))
                                <span class="badge-royal-new mt-1.5">&#10022; Needs attention</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Recent enquiries + quick actions -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="card-royal lg:col-span-2">
                <div class="flex items-center justify-between border-b border-gold-300/15 bg-gradient-to-r from-brand-50/50 to-transparent px-6 py-4 dark:from-white/[0.02]">
                    <div class="flex items-center gap-2.5">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-brand-500 to-brand-700 text-gold-100 shadow-[0_4px_10px_-3px_rgba(163,32,43,0.5)]">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 8.187V17.25c0 .414.336.75.75.75h15.5a.75.75 0 0 0 .75-.75V8.187l-8.29 5.03a1.5 1.5 0 0 1-1.573 0L3.5 8.187Z" fill="currentColor"/><path d="M20.5 6.229a.75.75 0 0 0-.75-.729H4.25a.75.75 0 0 0-.75.729l8.29 5.028a.75.75 0 0 0 .78 0l8.29-5.028Z" fill="currentColor"/></svg>
                        </span>
                        <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Recent Enquiries</h3>
                    </div>
                    <a href="{{ route('contact-messages.index') }}" class="text-sm font-medium text-brand-600 hover:text-brand-800 dark:text-gold-300 dark:hover:text-gold-200">View all &rarr;</a>
                </div>
                <div class="divide-y divide-gold-300/10">
                    @forelse ($recentMessages as $message)
                        <a href="{{ route('contact-messages.show', $message) }}" class="group flex items-start gap-3.5 border-l-2 border-transparent px-6 py-4 transition hover:border-gold-300 hover:bg-brand-50/40 dark:hover:bg-white/[0.02]">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-gold-200 to-gold-400 font-display text-sm font-semibold text-brand-800 shadow-theme-xs">
                                {{ strtoupper(substr($message->name, 0, 1)) }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="truncate font-medium text-gray-700 dark:text-gray-300">{{ $message->name }}</p>
                                    <span class="shrink-0 text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-0.5 truncate text-sm text-gray-500 dark:text-gray-400">{{ $message->message }}</p>
                            </div>
                            @unless ($message->is_read)
                                <span class="badge-royal-new mt-0.5 shrink-0">New</span>
                            @endunless
                        </a>
                    @empty
                        <div class="flex flex-col items-center gap-2 px-6 py-14 text-center">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" class="text-gold-300/60" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 8.187V17.25c0 .414.336.75.75.75h15.5a.75.75 0 0 0 .75-.75V8.187l-8.29 5.03a1.5 1.5 0 0 1-1.573 0L3.5 8.187Z" fill="currentColor"/><path d="M20.5 6.229a.75.75 0 0 0-.75-.729H4.25a.75.75 0 0 0-.75.729l8.29 5.028a.75.75 0 0 0 .78 0l8.29-5.028Z" fill="currentColor"/></svg>
                            <p class="text-sm text-gray-500 dark:text-gray-400">No enquiries yet &mdash; they'll show up here as visitors submit the contact form.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card-royal">
                <div class="flex items-center gap-2.5 border-b border-gold-300/15 bg-gradient-to-r from-brand-50/50 to-transparent px-6 py-4 dark:from-white/[0.02]">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-gold-300 to-gold-500 text-brand-900 shadow-[0_4px_10px_-3px_rgba(216,178,94,0.6)]">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z"/></svg>
                    </span>
                    <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Quick Actions</h3>
                </div>
                <div class="grid grid-cols-1 gap-2.5 p-4 sm:grid-cols-2 lg:grid-cols-1">
                    @foreach ($quickActions as $action)
                        <a href="{{ $action['href'] }}" class="group flex items-center gap-3 rounded-xl border border-transparent px-3 py-2.5 transition hover:border-gold-300/40 hover:bg-brand-50/50 dark:hover:bg-white/[0.03]">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-brand-500 to-brand-700 text-gold-100 shadow-[0_4px_10px_-3px_rgba(163,32,43,0.45)] transition duration-200 group-hover:scale-105 [&>svg]:h-4.5 [&>svg]:w-4.5">
                                {!! MenuHelper::getIconSvg($action['icon']) !!}
                            </span>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $action['label'] }}</span>
                            <svg class="ml-auto h-4 w-4 shrink-0 text-gold-400 opacity-0 transition group-hover:opacity-100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
