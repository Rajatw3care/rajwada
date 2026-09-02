<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Success Stories — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</title>
<meta name="description" content="Explore real weddings and events crafted by {{ $settings['site_name'] ?? 'Rajwada Events' }} — celebration journeys, highlights and memorable moments.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('frontend.partials.header', ['active' => 'success-story'])

<main id="top">

  <!-- ============ HERO / PAGE BANNER ============ -->
  <section class="page-banner" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} Success Stories">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('assets/gallery-5.webp') }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</p>
      <h1>Success Stories</h1>
      <p class="page-intro">Every celebration below was designed, planned and brought to life by our team — from the first venue visit to the final farewell dance.</p>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Success Stories</span>
      </nav>
    </div>
  </section>

  <!-- ============ EVENT JOURNEY ============ -->
  <section class="journey" id="event-journey" aria-labelledby="event-journey-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="event-journey-title">Event Journey</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">The planning process, event highlights and memorable moments behind every celebration we craft.</p>

      <div class="journey-steps">
        <div class="journey-step">
          <span class="journey-step__num">1</span>
          <div class="journey-step__icon"><img src="{{ asset('assets/icon-planning.webp') }}" alt="" loading="lazy"></div>
          <h3>Discovery &amp; Planning</h3>
          <p>We learn your story, set the budget and timeline, and shortlist venues that fit your vision.</p>
        </div>
        <div class="journey-step">
          <span class="journey-step__num">2</span>
          <div class="journey-step__icon"><img src="{{ asset('assets/icon-favours.webp') }}" alt="" loading="lazy"></div>
          <h3>Design &amp; Styling</h3>
          <p>Themes, decor, florals and lighting are curated to bring your celebration's mood to life.</p>
        </div>
        <div class="journey-step">
          <span class="journey-step__num">3</span>
          <div class="journey-step__icon"><img src="{{ asset('assets/icon-operations.webp') }}" alt="" loading="lazy"></div>
          <h3>Event Execution</h3>
          <p>Our team manages every ceremony, vendor and cue on the ground, keeping the day stress-free.</p>
        </div>
        <div class="journey-step">
          <span class="journey-step__num">4</span>
          <div class="journey-step__icon"><img src="{{ asset('assets/heart.svg') }}" alt="" loading="lazy"></div>
          <h3>Cherished Memories</h3>
          <p>Photos, films and highlights are delivered so the celebration lives on long after the last dance.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ============ GALLERY ============ -->
  @if ($galleryImages->isNotEmpty())
  <section class="gallery" id="gallery" aria-labelledby="gallery-title">
    <div class="container">
      <h2 class="section-title section-title--cursive title-cream" id="gallery-title">Photo &amp; Video Gallery</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead section-lead--light">A glimpse into the unforgettable celebrations we have crafted, where every detail tells a story.</p>

      <div class="gallery__grid">
        @foreach ($galleryImages as $index => $image)
          <figure class="g{{ $index + 1 }} @if(in_array($index, [1,3,6,7])) small-thumb @endif">
            <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->alt_text }}" loading="lazy">
          </figure>
        @endforeach
      </div>

      <div class="center-action">
        <a class="btn-ornate btn-ornate--gold" href="{{ route('gallery') }}"><img src="{{ asset('assets/btn-ornate-gold.webp') }}" alt="" aria-hidden="true">View all</a>
      </div>
    </div>
  </section>
  @endif

  <!-- ============ SUCCESS STORY LISTING ============ -->
  @if ($successStories->isNotEmpty())
  <section class="services" id="story-listing" aria-labelledby="story-listing-title">
    <div class="container">
      <div class="services__head">
        <h2 class="section-title title-maroon" id="story-listing-title">Success Story Listing</h2>
        <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <p class="section-lead">Completed weddings and events, in the couples' own celebration cities.</p>
      </div>

      <div class="story-grid">
        @foreach ($successStories as $story)
          <article class="story-card">
            <div class="story-card__media">
              <img src="{{ asset('storage/'.$story->image) }}" alt="{{ $story->title }}" loading="lazy">
              @if ($story->location)
                <span class="story-card__location">
                  <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg>
                  {{ $story->location }}
                </span>
              @endif
            </div>
            <div class="story-card__body">
              <h3>{{ $story->title }}</h3>
              <p>{{ $story->description }}</p>
              <a class="pill-link" href="{{ route('gallery') }}">View Story</a>
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ VIDEO GALLERY ============ -->
  @if ($videos->isNotEmpty())
  <section class="video-gallery" aria-labelledby="video-title">
    <div class="container">
      <h2 class="section-title title-cream" id="video-title">Highlight Films</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead section-lead--light">Wedding films that bring each success story back to life.</p>

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

      <div class="center-action">
        <a class="btn-ornate btn-ornate--gold" href="{{ route('gallery') }}"><img src="{{ asset('assets/btn-ornate-gold.webp') }}" alt="" aria-hidden="true">View Full Gallery</a>
      </div>
    </div>
  </section>
  @endif

  <!-- ============ FEATURED DESTINATIONS ============ -->
  @if ($destinations->isNotEmpty())
  <section class="destinations" id="destinations" aria-labelledby="destinations-title">
    <div class="container">
      <div class="services__head">
        <h2 class="section-title title-maroon" id="destinations-title">Featured Destinations</h2>
        <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <p class="section-lead">Weddings and events we've crafted across Rajasthan and beyond.</p>
      </div>

      <div class="destination-grid">
        @foreach ($destinations as $destination)
          <div class="destination-card">
            <img src="{{ asset('storage/'.$destination->image) }}" alt="{{ $destination->name }}" loading="lazy">
            <div class="destination-card__meta">
              <h3>{{ $destination->name }}</h3>
              <span>{{ $destination->count_label }}</span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ CALL TO ACTION ============ -->
  <section class="cta-band" id="plan-event" aria-labelledby="cta-title">
    <div class="container">
      <h2 id="cta-title">Let's Create Your Own Success Story</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p>Connect with our team to start planning a celebration as memorable as the ones above.</p>
      <div class="cta-actions">
        <a class="btn-frame" href="{{ route('contact') }}"><span>Plan Your Event</span></a>
        <a class="btn-frame" href="{{ route('services') }}"><span>Explore Services</span></a>
      </div>
    </div>
  </section>

</main>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

</body>
</html>
