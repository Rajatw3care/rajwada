<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Testimonials — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Royal Creators' }}</title>
<meta name="description" content="Read genuine client reviews and watch video testimonials from couples and families who trusted {{ $settings['site_name'] ?? 'Rajwada Events' }} to craft their royal weddings.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
</head>

<body>

@include('frontend.partials.header', ['active' => 'testimonials'])

<main id="top">

  <!-- ============ PAGE BANNER ============ -->
  <section class="page-banner" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} Testimonials">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('assets/hero-lake.webp') }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Royal Creators' }}</p>
      <h1>Testimonials</h1>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Testimonials</span>
      </nav>
    </div>
  </section>

  <!-- ============ TESTIMONIALS ============ -->
  @if ($testimonials->isNotEmpty())
  <section class="testimonials" id="testimonials" aria-labelledby="testi-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="testi-title">Client Testimonials</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">Real words from real celebrations — families and couples share what it felt like to plan their big day with {{ $settings['site_name'] ?? 'Rajwada Events' }}.</p>

      <div class="testi__track">
        @foreach ($testimonials as $testimonial)
          <div class="testi-card-item">
            <figure class="testi-card">
              <svg class="testi-card__quote" viewBox="0 0 48 40" aria-hidden="true">
                <path d="M0 40C0 18 8 4 22 0l4 9C17 13 12 20 12 28h10v12zm26 0c0-22 8-36 22-40l4 9c-9 4-14 11-14 19h10v12z"/>
              </svg>
              <div class="testi-card__avatar">
                @if ($testimonial->avatar)<img src="{{ asset('storage/'.$testimonial->avatar) }}" alt="{{ $testimonial->name }}" loading="lazy">@endif
              </div>
              <figcaption>
                <h3>{{ $testimonial->name }}</h3>
              </figcaption>
              <p>{{ $testimonial->message }}</p>
            </figure>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ VIDEO TESTIMONIALS ============ -->
  @if ($videos->isNotEmpty())
  <section class="video-gallery" id="video-testimonials" aria-labelledby="video-testi-title">
    <div class="container">
      <h2 class="section-title title-cream" id="video-testi-title">Video Testimonials</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead section-lead--light">Hear it straight from our couples and families &mdash; their own words on planning a celebration with {{ $settings['site_name'] ?? 'Rajwada Events' }}.</p>

      <div class="video-grid">
        @foreach ($videos as $video)
          <a class="video-card" href="{{ $video->video_url }}" target="_blank" rel="noopener" data-title="{{ $video->title }}" data-tag="{{ $video->tag }}">
            <img src="{{ asset('storage/'.$video->thumbnail) }}" alt="{{ $video->title }}" loading="lazy">
            <span class="video-card__scrim" aria-hidden="true"></span>
            @if ($video->duration)<span class="video-card__duration">{{ $video->duration }}</span>@endif
            <span class="video-card__play" aria-hidden="true">
              <svg viewBox="0 0 24 24"><path d="M6 4l14 8-14 8V4z"/></svg>
            </span>
            <span class="video-card__meta">
              <span class="video-card__tag">{{ $video->tag }}</span>
              <span class="video-card__title">{{ $video->title }}</span>
            </span>
          </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ FEATURED REVIEWS ============ -->
  @if ($featuredTestimonials->isNotEmpty())
  <section class="featured-reviews" id="featured-reviews" aria-labelledby="featured-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="featured-title">Featured Reviews</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">A closer look at some of the weddings and events our clients loved the most.</p>

      <div class="featured-grid">
        @foreach ($featuredTestimonials as $review)
          <figure class="featured-card">
            @if ($review->avatar)<img src="{{ asset('storage/'.$review->avatar) }}" alt="{{ $review->name }}" loading="lazy">@endif
            <span class="featured-card__scrim" aria-hidden="true"></span>
            <svg class="featured-card__quote" viewBox="0 0 48 40" aria-hidden="true">
              <path d="M0 40C0 18 8 4 22 0l4 9C17 13 12 20 12 28h10v12zm26 0c0-22 8-36 22-40l4 9c-9 4-14 11-14 19h10v12z"/>
            </svg>
            <figcaption class="featured-card__content">
              <span class="featured-card__stars" aria-hidden="true">
                @for ($i = 0; $i < ($review->rating ?? 5); $i++)
                  <svg viewBox="0 0 20 20"><path d="M10 1l2.6 5.9 6.4.6-4.8 4.3 1.4 6.2L10 14.9 4.4 18l1.4-6.2L1 7.5l6.4-.6z"/></svg>
                @endfor
              </span>
              <p>&ldquo;{{ $review->message }}&rdquo;</p>
              <span class="featured-card__name">{{ $review->name }}</span>
              @if ($review->event_label)<span class="featured-card__event">{{ $review->event_label }}</span>@endif
            </figcaption>
          </figure>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ CALL TO ACTION ============ -->
  <section class="cta-band" id="plan-event" aria-labelledby="cta-title">
    <div class="container">
      <h2 id="cta-title">Ready to write your own story with us? Let&rsquo;s start planning your special celebration.</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <div class="center-action">
        <a class="btn-ornate btn-ornate--gold" href="{{ route('contact') }}"><img src="{{ asset('assets/btn-ornate-gold.webp') }}" alt="" aria-hidden="true">Enquire Now</a>
      </div>
    </div>
  </section>

  <!-- ============ RATINGS & RECOGNITION ============ -->
  @if ($ratingStats->isNotEmpty())
  <section class="ratings" id="ratings" aria-labelledby="ratings-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="ratings-title">Ratings &amp; Recognition</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">The numbers behind every celebration we&rsquo;ve had the honour of planning.</p>

      <div class="ratings-grid">
        @foreach ($ratingStats as $stat)
          <div class="rating-card">
            <div class="rating-card__icon"><span style="font-size:2rem">{{ $stat->icon }}</span></div>
            <p class="rating-card__number">{{ $stat->number }}</p>
            <p class="rating-card__label">{{ $stat->label }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

</main>

<!-- ============ VIDEO PREVIEW (LIGHTBOX) ============ -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Video testimonial preview">
  <div class="lightbox__frame">
    <img class="lightbox__img" id="lbImg" src="" alt="">
    <span class="lightbox__play-badge" id="lbPlayBadge" aria-hidden="true">
      <svg viewBox="0 0 24 24"><path d="M6 4l14 8-14 8V4z"/></svg>
    </span>

    <button class="lightbox__close" id="lbClose" type="button" aria-label="Close preview">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><line x1="5" y1="5" x2="19" y2="19"/><line x1="19" y1="5" x2="5" y2="19"/></svg>
    </button>

    <div class="lightbox__caption">
      <p class="cat" id="lbCat"></p>
      <p class="ttl" id="lbTitle"></p>
    </div>
  </div>
</div>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
(function () {
  'use strict';
  var lightbox = document.getElementById('lightbox');
  var lbImg = document.getElementById('lbImg');
  var lbCat = document.getElementById('lbCat');
  var lbTitle = document.getElementById('lbTitle');
  var lbClose = document.getElementById('lbClose');

  Array.prototype.slice.call(document.querySelectorAll('.video-card')).forEach(function (card) {
    card.addEventListener('click', function (e) {
      e.preventDefault();
      var img = card.querySelector('img');
      lbImg.src = img.src;
      lbImg.alt = img.alt;
      lbCat.textContent = card.dataset.tag || '';
      lbTitle.textContent = card.dataset.title || '';
      lightbox.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    });
  });

  lbClose.addEventListener('click', function () {
    lightbox.classList.remove('is-open');
    document.body.style.overflow = '';
  });

  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) { lightbox.classList.remove('is-open'); document.body.style.overflow = ''; }
  });
})();

$(document).ready(function () {
  $('.testi__track').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    centerPadding: '0px',
    infinite: true,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 5000,
    speed: 700,
    pauseOnHover: false,
    pauseOnFocus: false,
    responsive: [
      { breakpoint: 1200, settings: { slidesToShow: 3 } },
      { breakpoint: 768, settings: { slidesToShow: 1, centerMode: true } },
      { breakpoint: 576, settings: { slidesToShow: 1, centerMode: false } }
    ]
  });
});
</script>

</body>
</html>
