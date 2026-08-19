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
    @endphp

    <div class="space-y-6">

        <!-- Welcome banner -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-brand-900 via-brand-800 to-brand-950 px-6 py-8 shadow-theme-lg md:px-10 md:py-10">
            <img src="{{ asset('images/logo/rajwada-logo.png') }}" alt="" aria-hidden="true"
                class="pointer-events-none absolute -right-6 -top-6 h-56 w-56 object-contain opacity-10 md:h-72 md:w-72" />
            <div class="relative">
                <p class="text-theme-xs uppercase tracking-[0.2em] text-gold-300/80">Rajwada Events Admin</p>
                <h2 class="mt-2 font-display text-2xl font-semibold text-white md:text-3xl">
                    Welcome back, {{ explode(' ', auth()->user()->name)[0] }}
                </h2>
                <p class="mt-2 max-w-xl text-sm text-white/60">
                    Everything you publish here goes live on the website instantly &mdash; no rebuild, no waiting.
                </p>
                <a href="{{ route('home') }}" target="_blank"
                    class="mt-5 inline-flex items-center gap-2 rounded-lg border border-gold-300/40 bg-white/5 px-5 py-2.5 text-sm font-medium text-gold-200 transition hover:bg-white/10 hover:text-gold-100">
                    View live site
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 17L17 7M17 7H8M17 7V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>

        <!-- Stat cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
            @foreach ($cards as $card)
                <a href="{{ $card['href'] }}"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-brand-200 hover:shadow-theme-md dark:border-gray-800 dark:bg-white/[0.03] dark:hover:border-brand-800">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl {{ !empty($card['highlight']) ? 'bg-brand-500 text-white' : 'bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400' }}">
                        <span class="[&>svg]:h-5 [&>svg]:w-5">{!! MenuHelper::getIconSvg($card['icon']) !!}</span>
                    </div>
                    <div class="mt-4">
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $card['label'] }}</span>
                        <h4 class="mt-1 font-display text-2xl font-semibold text-gray-800 dark:text-white/90">{{ $card['value'] }}</h4>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-l-2 border-gold-300 pl-4">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Manage your site</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Use the <strong class="text-gray-700 dark:text-gray-300">Site Content</strong> menu on the left to edit the Hero section, About Us, Services,
                    Gallery, Blogs &amp; Stories, Testimonials and Site Settings &mdash; every change is reflected instantly on
                    the public website.
                </p>
            </div>
        </div>
    </div>
@endsection
