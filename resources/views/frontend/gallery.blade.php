<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gallery — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Royal Creators' }}</title>
<meta name="description" content="Explore {{ $settings['site_name'] ?? 'Rajwada Events' }}' portfolio of royal weddings, destination celebrations and ceremonies — photo galleries, highlight films and cinematic wedding stories.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('frontend.partials.header', ['active' => 'gallery'])

<main id="top">

  <!-- ============ PAGE BANNER ============ -->
  <section class="page-banner" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} Gallery">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('assets/gallery-5.webp') }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Royal Creators' }}</p>
      <h1>Gallery</h1>
      <p class="page-intro">A window into every celebration we craft — high-quality images and highlight films from royal weddings, haldi, mehendi, sangeet and reception nights across Rajasthan.</p>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Gallery</span>
      </nav>
    </div>
  </section>

  <!-- ============ PHOTO GALLERY + FILTER ============ -->
  <section class="photo-gallery" id="photo-gallery" aria-labelledby="photo-gallery-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="photo-gallery-title">Photo Gallery</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">Browse our high-quality images, categorised by event type — from royal weddings to intimate ceremonies.</p>

      <div class="gallery-filter" role="tablist" aria-label="Filter gallery by category">
        <button class="gallery-filter__btn is-active" type="button" data-filter="all" role="tab" aria-selected="true">All</button>
        <button class="gallery-filter__btn" type="button" data-filter="royal" role="tab" aria-selected="false">Royal Weddings</button>
        <button class="gallery-filter__btn" type="button" data-filter="destination" role="tab" aria-selected="false">Destination Weddings</button>
        <button class="gallery-filter__btn" type="button" data-filter="haldi" role="tab" aria-selected="false">Haldi Ceremony</button>
        <button class="gallery-filter__btn" type="button" data-filter="mehendi" role="tab" aria-selected="false">Mehendi Ceremony</button>
        <button class="gallery-filter__btn" type="button" data-filter="sangeet" role="tab" aria-selected="false">Sangeet Night</button>
        <button class="gallery-filter__btn" type="button" data-filter="reception" role="tab" aria-selected="false">Reception</button>
      </div>

      <div class="photo-masonry" id="photoMasonry">
        @php $catLabels = ['royal' => 'Royal Weddings', 'destination' => 'Destination Weddings', 'haldi' => 'Haldi Ceremony', 'mehendi' => 'Mehendi Ceremony', 'sangeet' => 'Sangeet Night', 'reception' => 'Reception']; @endphp
        @forelse ($galleryImages as $image)
          <button class="photo-masonry__item" type="button" data-category="{{ $image->category ?? 'royal' }}" data-title="{{ $image->title ?? $image->alt_text }}" data-cat-label="{{ $catLabels[$image->category] ?? '' }}">
            <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->alt_text }}" loading="lazy">
            <span class="photo-masonry__item__overlay">
              <span class="photo-masonry__item__cat">{{ $catLabels[$image->category] ?? '' }}</span>
              <span class="photo-masonry__item__title">{{ $image->title }}</span>
            </span>
            <span class="photo-masonry__item__zoom" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </span>
          </button>
        @empty
          <p>No gallery images yet — check back soon.</p>
        @endforelse
      </div>

      <p class="gallery-empty" id="galleryEmpty">No moments in this category just yet — more stories coming soon.</p>

      <div class="gallery-cta">
        <p>Loved what you see? Let&rsquo;s start planning a celebration of your own.</p>
        <div class="center-action">
          <a class="btn-ornate" href="{{ route('contact') }}"><img src="{{ asset('assets/btn-ornate-red.webp') }}" alt="" aria-hidden="true">Enquire Now</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ VIDEO GALLERY ============ -->
  @if ($videos->isNotEmpty())
  <section class="video-gallery" id="video-gallery" aria-labelledby="video-gallery-title">
    <div class="container">
      <h2 class="section-title title-cream" id="video-gallery-title">Video Gallery</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead section-lead--light">Event highlight videos and wedding films that bring every celebration back to life.</p>

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

</main>

<!-- ============ IMAGE PREVIEW (LIGHTBOX) ============ -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Gallery preview">
  <div class="lightbox__frame">
    <button class="lightbox__nav lightbox__nav--prev" id="lbPrev" type="button" aria-label="Previous">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
    </button>

    <img class="lightbox__img" id="lbImg" src="" alt="">

    <button class="lightbox__nav lightbox__nav--next" id="lbNext" type="button" aria-label="Next">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
    </button>

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

<script>
(function () {
  'use strict';

  var filterBtns = Array.prototype.slice.call(document.querySelectorAll('.gallery-filter__btn'));
  var items = Array.prototype.slice.call(document.querySelectorAll('.photo-masonry__item'));
  var emptyMsg = document.getElementById('galleryEmpty');

  function applyFilter(value) {
    var visibleCount = 0;
    items.forEach(function (item) {
      var match = value === 'all' || item.dataset.category === value;
      item.classList.toggle('is-hidden', !match);
      if (match) visibleCount++;
    });
    emptyMsg.classList.toggle('is-visible', visibleCount === 0);
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) {
        b.classList.remove('is-active');
        b.setAttribute('aria-selected', 'false');
      });
      btn.classList.add('is-active');
      btn.setAttribute('aria-selected', 'true');
      applyFilter(btn.dataset.filter);
    });
  });

  var lightbox = document.getElementById('lightbox');
  var lbImg = document.getElementById('lbImg');
  var lbCat = document.getElementById('lbCat');
  var lbTitle = document.getElementById('lbTitle');
  var lbClose = document.getElementById('lbClose');
  var lbPrev = document.getElementById('lbPrev');
  var lbNext = document.getElementById('lbNext');

  var photoItems = items;
  var currentIndex = -1;

  function openPhoto(index) {
    currentIndex = index;
    var item = photoItems[index];
    var img = item.querySelector('img');
    lbImg.src = img.src;
    lbImg.alt = img.alt;
    lbCat.textContent = item.dataset.catLabel || '';
    lbTitle.textContent = item.dataset.title || '';
    openLightbox();
  }

  function openLightbox() {
    lightbox.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox() {
    lightbox.classList.remove('is-open');
    document.body.style.overflow = '';
  }

  function step(dir) {
    if (currentIndex === -1) return;
    var next = (currentIndex + dir + photoItems.length) % photoItems.length;
    openPhoto(next);
  }

  photoItems.forEach(function (item, index) {
    item.addEventListener('click', function () { openPhoto(index); });
  });

  lbClose.addEventListener('click', closeLightbox);
  lbPrev.addEventListener('click', function () { step(-1); });
  lbNext.addEventListener('click', function () { step(1); });

  lightbox.addEventListener('click', function (e) {
    if (e.target === lightbox) closeLightbox();
  });

  document.addEventListener('keydown', function (e) {
    if (!lightbox.classList.contains('is-open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') step(-1);
    if (e.key === 'ArrowRight') step(1);
  });
})();
</script>

</body>
</html>
