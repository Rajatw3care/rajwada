<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $blogPost->title }} — {{ $settings['site_name'] ?? 'Rajwada Events' }}</title>
<meta name="description" content="{{ $blogPost->excerpt }}">
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

  <!-- ============ POST HEADER / BANNER ============ -->
  <section class="page-banner post-header" aria-label="Blog post header">
    <div class="page-banner__media" aria-hidden="true">
      @if ($blogPost->image)<img src="{{ asset('storage/'.$blogPost->image) }}" alt="" loading="eager" fetchpriority="high">@endif
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      @if ($blogPost->category)<p class="page-banner__eyebrow">{{ $blogPost->category }}</p>@endif
      <h1 style="font-size:clamp(26px,4vw,48px);">{{ $blogPost->title }}</h1>

      <p class="post-meta">
        <span>
          <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/></svg>
          {{ optional($blogPost->published_at ?? $blogPost->created_at)->format('d M Y') }}
        </span>
        <span>
          <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-7 8-7s8 3 8 7"/></svg>
          By {{ $settings['site_name'] ?? 'Rajwada Events' }}
        </span>
        @if ($blogPost->category)<span class="cat-pill">{{ $blogPost->category }}</span>@endif
      </p>

      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><a href="{{ route('blogs') }}">Blogs</a><span>/</span><span aria-current="page">{{ $blogPost->title }}</span>
      </nav>
    </div>
  </section>

  <!-- ============ POST CONTENT ============ -->
  <section class="blog-page" id="post" aria-label="Blog post content">
    <div class="container">
      <div class="blog-layout">

        <article class="post-body">
          {!! $blogPost->body !!}

          @if ($blogPost->tags)
            <div class="post-tags">
              <span class="label">Tags:</span>
              <div class="tag-list">
                @foreach (explode(',', $blogPost->tags) as $tag)
                  @if (trim($tag) !== '')
                    <a href="{{ route('blogs') }}">{{ trim($tag) }}</a>
                  @endif
                @endforeach
              </div>
            </div>
          @endif

          @php
            $showFacebookShare = ($settings['share_facebook'] ?? '1') !== '0' && filled($blogPost->share_facebook_url);
            $showTwitterShare = ($settings['share_twitter'] ?? '1') !== '0' && filled($blogPost->share_twitter_url);
            $showWhatsappShare = ($settings['share_whatsapp'] ?? '1') !== '0' && filled($blogPost->share_whatsapp_url);
            $showEmailShare = ($settings['share_email'] ?? '1') !== '0' && filled($blogPost->share_email_url);
          @endphp
          @if ($showFacebookShare || $showTwitterShare || $showWhatsappShare || $showEmailShare)
          <div class="share-row" aria-label="Share this article">
            <span class="label">Share:</span>
            @if ($showFacebookShare)
            <a class="share-icon" href="{{ $blogPost->share_facebook_url }}" target="_blank" rel="noopener" aria-label="Share on Facebook">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-7.6h2.6l.4-3H13.5V8.4c0-.87.24-1.46 1.5-1.46h1.6V4.24C16.3 4.17 15.4 4.1 14.35 4.1c-2.2 0-3.7 1.34-3.7 3.8v2.5H8v3h2.65V21h2.85Z"/></svg>
            </a>
            @endif
            @if ($showTwitterShare)
            <a class="share-icon" href="{{ $blogPost->share_twitter_url }}" target="_blank" rel="noopener" aria-label="Share on X / Twitter">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.9 3H21l-6.6 7.5L22 21h-6.2l-4.9-6.4L5.3 21H3.2l7-8-7.8-10h6.4l4.4 5.9L18.9 3Zm-1.1 16.2h1.2L7.3 4.7H6l11.8 14.5Z"/></svg>
            </a>
            @endif
            @if ($showWhatsappShare)
            <a class="share-icon" href="{{ $blogPost->share_whatsapp_url }}" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.04 2C6.6 2 2.16 6.45 2.16 11.9c0 1.83.5 3.53 1.36 5l-1.4 4.15 4.3-1.36a9.9 9.9 0 0 0 5.62 1.75c5.44 0 9.87-4.45 9.87-9.9 0-2.65-1.03-5.13-2.9-7A9.83 9.83 0 0 0 12.04 2Zm5.75 14.02c-.24.68-1.4 1.3-1.94 1.35-.5.06-1.03.28-3.5-.73-2.95-1.22-4.85-4.2-5-4.4-.14-.19-1.2-1.6-1.2-3.04 0-1.45.75-2.16 1.02-2.46.27-.3.58-.36.78-.36l.55.01c.18 0 .4-.03.63.48.24.53.8 1.85.87 1.98.07.14.12.3.02.48-.1.2-.15.31-.3.48l-.44.5c-.14.15-.3.31-.13.6.17.3.77 1.28 1.66 2.07 1.14 1.02 2.1 1.34 2.4 1.5.3.13.47.11.65-.07.17-.18.74-.86.94-1.16.2-.3.4-.24.66-.14.28.1 1.76.83 2.06.98.3.15.5.22.57.35.08.13.08.75-.17 1.43Z"/></svg>
            </a>
            @endif
            @if ($showEmailShare)
            <a class="share-icon" href="mailto:{{ $blogPost->share_email_url }}" aria-label="Share via Email">
              <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 6h18v12H3V6Zm0 0 9 6 9-6"/></svg>
            </a>
            @endif
          </div>
          @endif

          <div class="author-box">
            @if (!empty($settings['logo']))<img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'Rajwada Events' }}">@endif
            <div>
              <h4>{{ $settings['site_name'] ?? 'Rajwada Events' }}</h4>
              <p>{{ $settings['site_tagline'] ?? "Jaipur's royal wedding & event curators." }}</p>
            </div>
          </div>
        </article>

        @include('frontend.partials.blog-sidebar')
      </div>
    </div>
  </section>

  <!-- ============ RELATED BLOGS ============ -->
  @if ($relatedPosts->isNotEmpty())
  <section class="blogs" id="related" aria-labelledby="related-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="related-title">Related Articles</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">More stories and ideas from {{ $settings['site_name'] ?? 'Rajwada Events' }}.</p>

      <div class="blogs__grid">
        @foreach ($relatedPosts as $related)
          <article class="blog-card">
            <figure class="blog-card__media">
              @if ($related->image)<img src="{{ asset('storage/'.$related->image) }}" alt="{{ $related->title }}" loading="lazy">@endif
            </figure>
            <h3>{{ $related->title }}</h3>
            <p class="venue">{{ $related->category }}</p>
            <a class="btn-pill" href="{{ route('blog.show', $related->slug) }}">Read more</a>
          </article>
        @endforeach
      </div>

      <div class="center-action">
        <a class="btn-ornate" href="{{ route('blogs') }}"><img src="{{ asset('assets/btn-ornate-red.webp') }}" alt="" aria-hidden="true">See More Articles</a>
      </div>
    </div>
  </section>
  @endif

</main>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

</body>
</html>
