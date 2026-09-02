<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Our Services — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</title>
<meta name="description" content="Explore {{ $settings['site_name'] ?? 'Rajwada Events' }}' full range of wedding and event management services — venue booking, planning, entertainment, photography, catering, styling and more.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('frontend.partials.header', ['active' => 'services'])

<main id="top">

  <!-- ============ PAGE BANNER ============ -->
  <section class="page-banner" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} Services">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('assets/gallery-6.webp') }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</p>
      <h1>Our Services</h1>
      <p class="page-intro">From the first venue visit to the final farewell, our team designs, plans and manages every requirement of your event with the elegance of Rajasthan's royal heritage and the precision of a seasoned crew.</p>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Services</span>
      </nav>
    </div>
  </section>

  <!-- ============ SERVICE LISTING ============ -->
  @if ($services->isNotEmpty())
  <section class="services" id="service-listing" aria-labelledby="service-listing-title">
    <img class="services__mascot" src="{{ asset('assets/mascot.webp') }}" alt="" aria-hidden="true" loading="lazy">
    <div class="container">
      <div class="services__head">
        <h2 class="section-title title-emboss" id="service-listing-title">Service Listing</h2>
        <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <p class="section-lead">Every service your celebration needs, under one royal roof.</p>
      </div>

      <div class="services__grid">
        @foreach ($services as $service)
          <article class="service-card">
            <div class="service-card__icon">
              @if ($service->icon)<img src="{{ asset('storage/'.$service->icon) }}" alt="" loading="lazy">@endif
            </div>
            <h3>{{ $service->title }}</h3>
            <svg class="rule" viewBox="0 0 120 10" aria-hidden="true"><g fill="none" stroke="#cbbf9a" stroke-width=".9"><line x1="0" y1="5" x2="46" y2="5"/><line x1="74" y1="5" x2="120" y2="5"/><circle cx="60" cy="5" r="3"/><circle cx="52" cy="5" r="2"/><circle cx="68" cy="5" r="2"/></g></svg>
            <p>{{ $service->description }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ CALL TO ACTION ============ -->
  <section class="cta-band" id="enquire" aria-labelledby="cta-title">
    <div class="container">
      <h2 id="cta-title">Ready To Plan Your Royal Celebration?</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p>Tell us a little about your event and our team will help you choose and book the exact services you need — from venue to farewell.</p>
      <div class="cta-actions">
        <a class="btn-frame" href="{{ route('contact') }}"><span>Enquire Now</span></a>
        <a class="btn-frame" href="{{ route('gallery') }}"><span>View Portfolio</span></a>
      </div>
    </div>
  </section>

  <!-- ============ SERVICE OVERVIEW ============ -->
  @if ($services->isNotEmpty())
  <section class="blogs service-overview" id="service-overview" aria-labelledby="service-overview-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="service-overview-title">Service Overview</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">A closer look at how each service comes together — open any service to enquire about the details for your celebration.</p>

      <div class="blogs__grid">
        @foreach ($services as $service)
          <article class="blog-card">
            <figure class="blog-card__media">
              @if ($service->overview_image)
                <img src="{{ asset('storage/'.$service->overview_image) }}" alt="{{ $service->title }}" loading="lazy">
              @elseif ($service->icon)
                <img src="{{ asset('storage/'.$service->icon) }}" alt="{{ $service->title }}" loading="lazy">
              @endif
            </figure>
            <h3>{{ $service->title }}</h3>
            <p class="venue">{{ $service->overview_description ?? $service->description }}</p>
            <a class="btn-pill" href="{{ route('contact') }}">View Details</a>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

</main>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

</body>
</html>
