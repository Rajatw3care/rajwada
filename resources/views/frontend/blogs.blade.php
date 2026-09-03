<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blogs &amp; Stories — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</title>
<meta name="description" content="Wedding inspiration, planning tips and real celebrations from {{ $settings['site_name'] ?? 'Rajwada Events' }} — Jaipur's royal wedding & event curators.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap"></noscript>
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('frontend.partials.header', ['active' => 'blogs'])

<main id="top">

  <!-- ============ PAGE BANNER ============ -->
  <section class="page-banner" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} Blogs &amp; Stories">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('assets/hero-lake.webp') }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</p>
      <h1>Blogs</h1>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Blogs</span>
      </nav>
    </div>
  </section>

  <!-- ============ BLOG LISTING ============ -->
  <section class="blog-page" id="blog-listing" aria-labelledby="blog-listing-title">
    <div class="container">
      <h2 class="sr-only" id="blog-listing-title">Blog articles</h2>

      @if ($featuredPost)
        <article class="featured-post">
          <div class="featured-post__media">
            <span class="featured-post__badge">Featured</span>
            @if ($featuredPost->image)<img src="{{ asset('storage/'.$featuredPost->image) }}" alt="{{ $featuredPost->title }}" loading="lazy">@endif
          </div>
          <div class="featured-post__body">
            <p class="post-meta">
              @if ($featuredPost->category)<span class="cat-pill">{{ $featuredPost->category }}</span>@endif
              <span>
                <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/></svg>
                {{ optional($featuredPost->published_at ?? $featuredPost->created_at)->format('d M Y') }}
              </span>
            </p>
            <h2>{{ $featuredPost->title }}</h2>
            <p>{{ $featuredPost->excerpt }}</p>
            <a class="btn-frame" href="{{ route('blog.show', $featuredPost->slug) }}"><span>Read More</span></a>
          </div>
        </article>
      @endif
    </div>

    <div class="blog-list-page">
      <div class="container">
        <div class="blog-layout">
          <div>
            <div class="blog-list">
              @forelse ($blogPosts as $post)
                <article class="blog-card">
                  <figure class="blog-card__media">
                    @if ($post->image)<img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" loading="lazy">@endif
                  </figure>
                  <h3>{{ $post->title }}</h3>
                  <p class="post-meta">
                    @if ($post->category)<span class="cat-pill">{{ $post->category }}</span>@endif
                    <span>{{ optional($post->published_at ?? $post->created_at)->format('d M Y') }}</span>
                  </p>
                  <a class="btn-pill" href="{{ route('blog.show', $post->slug) }}">Read more</a>
                </article>
              @empty
                <p>@if($search !== '') No articles matched "{{ $search }}". @else No blog posts yet — check back soon. @endif</p>
              @endforelse
            </div>

            {{ $blogPosts->links('frontend.partials.pagination') }}
          </div>

          @include('frontend.partials.blog-sidebar')
        </div>
      </div>
    </div>
  </section>

</main>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

</body>
</html>
