<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>About Us — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Royal Creators' }}</title>
<meta name="description" content="Meet {{ $settings['site_name'] ?? 'Rajwada Events' }} — Jaipur's royal wedding & event curators. Our story, our vision, our team, and the ceremonies we craft with heritage and heart.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('frontend.partials.header', ['active' => 'about'])

<main id="top">

  <!-- ============ PAGE BANNER ============ -->
  <section class="page-banner" aria-label="About {{ $settings['site_name'] ?? 'Rajwada Events' }}">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('storage/'.($about->page_banner_image ?? 'site/hero/hero-lake.jpg')) }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Royal Creators' }}</p>
      <h1>About Us</h1>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">About Us</span>
      </nav>
    </div>
  </section>

  <!-- ============ COMPANY OVERVIEW ============ -->
  @if ($about)
  <section class="about" id="overview" aria-labelledby="overview-title">
    <div class="container about__grid">

      <div class="about__collage">
        @if ($about->image_1)<figure class="collage-b"><img src="{{ asset('storage/'.$about->image_1) }}" alt="" loading="lazy"></figure>@endif
        @if ($about->image_2)<figure class="collage-a"><img src="{{ asset('storage/'.$about->image_2) }}" alt="" loading="lazy"></figure>@endif
        @if ($about->image_3)<figure class="collage-c"><img src="{{ asset('storage/'.$about->image_3) }}" alt="" loading="lazy"></figure>@endif
        @if ($about->badge_image)
          <p class="collage-badge"><img src="{{ asset('storage/'.$about->badge_image) }}" alt=""></p>
        @endif
      </div>

      <div class="about__panel">
        <img class="ornament" src="{{ asset('assets/about-title-bg.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <h2 id="overview-title">Company Overview</h2>

        <div class="about__copy">
          {!! $about->body !!}
        </div>

        <div class="about-btn"><a class="btn-frame" href="#story"><span>Our Story</span></a></div>

        <div class="about-icon">
          <img src="{{ asset('assets/about-icon.svg') }}" width="70" alt="" aria-hidden="true" loading="lazy">
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- ============ OUR STORY ============ -->
  @if ($timelineItems->isNotEmpty())
  <section class="story" id="story" aria-labelledby="story-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="story-title">Our Story</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">A decade-long journey of turning heartfelt promises into grand, unforgettable celebrations.</p>

      <div class="timeline">
        @foreach ($timelineItems as $item)
          <div class="timeline__item">
            <span class="timeline__dot" aria-hidden="true"></span>
            <p class="timeline__year">{{ $item->year }}</p>
            <div class="timeline__content">
              <h4>{{ $item->title }}</h4>
              <p>{{ $item->description }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ VISION & MISSION ============ -->
  @if ($about && ($about->vision || $about->mission))
  <section class="vm" id="vision-mission" aria-labelledby="vm-title">
    <div class="container">
      <div class="services__head">
        <h2 class="section-title title-cream" id="vm-title">Vision &amp; Mission</h2>
        <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      </div>

      <div class="vm__grid">
        @if ($about->vision)
        <div class="about__panel about__panel--flat">
          <img class="ornament" src="{{ asset('assets/about-title-bg.svg') }}" alt="" aria-hidden="true" loading="lazy">
          <h2>Our Vision</h2>
          <div class="about__copy"><p>{!! $about->vision !!}</p></div>
        </div>
        @endif

        @if ($about->mission)
        <div class="about__panel about__panel--flat">
          <img class="ornament" src="{{ asset('assets/about-title-bg.svg') }}" alt="" aria-hidden="true" loading="lazy">
          <h2>Our Mission</h2>
          <div class="about__copy"><p>{!! $about->mission !!}</p></div>
        </div>
        @endif
      </div>

      @if ($about->core_values)
        <ul class="core-values" aria-label="Our core values">
          @foreach (explode(',', $about->core_values) as $value)
            @if (trim($value) !== '')
              <li>{{ trim($value) }}</li>
            @endif
          @endforeach
        </ul>
      @endif
    </div>
  </section>
  @endif

  <!-- ============ WHY CHOOSE US ============ -->
  @if ($whyChooseItems->isNotEmpty())
  <section class="why-us" id="why-us" aria-labelledby="why-title">
    <img class="why-us__flourish why-us__flourish--tl" src="{{ asset('assets/flourish.svg') }}" alt="" aria-hidden="true" loading="lazy">
    <img class="why-us__flourish why-us__flourish--br" src="{{ asset('assets/flourish.svg') }}" alt="" aria-hidden="true" loading="lazy">
    <div class="container">
      <span class="why-us__eyebrow">The {{ $settings['site_name'] ?? 'Rajwada' }} Promise</span>
      <h2 class="section-title title-maroon" id="why-title">Why Choose {{ $settings['site_name'] ?? 'Rajwada Events' }}</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">Our strengths and our approach — the reasons couples across Rajasthan trust us with their biggest day.</p>

      <div class="why-us__grid">
        @foreach ($whyChooseItems as $index => $item)
          <article class="why-card">
            <span class="why-card__num">{{ sprintf('%02d', $index + 1) }}</span>
            <div class="why-card__icon">
              @if ($item->icon)<img src="{{ asset('storage/'.$item->icon) }}" alt="" loading="lazy">@endif
            </div>
            <h3>{{ $item->title }}</h3>
            <svg class="why-card__rule" viewBox="0 0 120 10" aria-hidden="true">
              <g fill="none" stroke="#d8b25e" stroke-width=".9">
                <line x1="0" y1="5" x2="46" y2="5"/><line x1="74" y1="5" x2="120" y2="5"/>
                <circle cx="60" cy="5" r="3"/><circle cx="52" cy="5" r="2"/><circle cx="68" cy="5" r="2"/>
              </g>
            </svg>
            <p>{{ $item->description }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ OUR PARTNERS ============ -->
  @if ($partners->isNotEmpty())
  <section class="partners" id="partners" aria-labelledby="partners-title">
    <div class="container">
      <h2 class="section-title title-cream" id="partners-title">Our Partners</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead section-lead--light">Trusted venues, vendors and businesses who help us bring every celebration to life.</p>

      <div class="our-partners">
        <div class="partners-slider">
          @foreach ($partners as $partner)
            <div class="partner">
              <div class="partner-box">
                <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}">
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- ============ OUR TEAM ============ -->
  @if ($teamMembers->isNotEmpty())
  <section class="team" id="team" aria-labelledby="team-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="team-title">Our Team</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">The people behind every {{ $settings['site_name'] ?? 'Rajwada Events' }} celebration.</p>

      <div class="blogs__grid">
        @foreach ($teamMembers as $member)
          <article class="blog-card">
            <figure class="blog-card__media">
              @if ($member->photo)<img src="{{ asset('storage/'.$member->photo) }}" alt="{{ $member->name }}" loading="lazy">@endif
            </figure>
            <h3>{{ $member->name }}</h3>
            <p class="venue">
              @if ($member->role)<strong>{{ $member->role }}</strong> &mdash; @endif{{ $member->description }}
            </p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ WEDDING CEREMONIES & EXPERIENCES ============ -->
  @if ($ceremonies->isNotEmpty())
  <section class="services" id="ceremonies" aria-labelledby="ceremonies-title">
    <img class="services__mascot" src="{{ asset('assets/mascot.webp') }}" alt="" aria-hidden="true" loading="lazy">
    <div class="container">
      <div class="services__head">
        <h2 class="section-title title-emboss" id="ceremonies-title">Wedding Ceremonies &amp; Experiences</h2>
        <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <p class="section-lead">Every ritual, reimagined with royal detail — from the first Mehendi to the final Reception toast.</p>
      </div>

      <div class="services__grid">
        @foreach ($ceremonies as $ceremony)
          <article class="service-card">
            <div class="service-card__icon">
              @if ($ceremony->icon)<img src="{{ asset('storage/'.$ceremony->icon) }}" alt="" loading="lazy">@endif
            </div>
            <h3>{{ $ceremony->title }}</h3>
            <svg class="rule" viewBox="0 0 120 10" aria-hidden="true"><g fill="none" stroke="#cbbf9a" stroke-width=".9"><line x1="0" y1="5" x2="46" y2="5"/><line x1="74" y1="5" x2="120" y2="5"/><circle cx="60" cy="5" r="3"/><circle cx="52" cy="5" r="2"/><circle cx="68" cy="5" r="2"/></g></svg>
            <p>{{ $ceremony->description }}</p>
          </article>
        @endforeach
      </div>

      <div class="center-action">
        <a class="btn-ornate" href="{{ route('home') }}#contact"><img src="{{ asset('assets/btn-ornate-red.webp') }}" alt="" aria-hidden="true">Plan Your Celebration</a>
      </div>
    </div>
  </section>
  @endif

</main>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
$(document).ready(function () {
  $('.partners-slider').slick({
    slidesToShow: 5,
    slidesToScroll: 5,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    arrows: false,
    dots: false,
    pauseOnHover: true,
    responsive: [
      { breakpoint: 992, settings: { slidesToShow: 3 } },
      { breakpoint: 768, settings: { slidesToShow: 2 } },
      { breakpoint: 480, settings: { slidesToShow: 1 } }
    ]
  });
});
</script>

</body>
</html>
