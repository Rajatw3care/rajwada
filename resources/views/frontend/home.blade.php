<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $settings['site_name'] ?? 'Rajwada Events' }} — {{ $settings['site_tagline'] ?? 'The Royal Creators' }}</title>
<meta name="description" content="{{ $settings['meta_description'] ?? '' }}">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

</head>

<body>

<!-- ============ HEADER ============ -->
<header class="site-header">
  <div class="container">
    <a class="brand" href="#top" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} — home">
      @if (!empty($settings['logo']))
        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'Rajwada Events' }}" width="180" height="120">
      @endif
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Toggle navigation menu">
      <span></span><span></span><span></span>
    </button>

    <nav class="main-nav" id="primary-nav" aria-label="Primary">
      <ul>
        <li><a href="#top" aria-current="page">Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#services">What We Do</a></li>
        <li><a href="#blogs">Blogs</a></li>
        <li><a href="#blogs">Stories</a></li>
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="#contact">Contact&nbsp; Us</a></li>
        <li><a href="#contact">Enquire Now</a></li>
      </ul>
    </nav>
  </div>
</header>

<main id="top">

  <!-- ============ HERO ============ -->
  @if ($hero)
  <section class="hero" aria-label="{{ $hero->subtitle }}">
    <div class="hero__media" aria-hidden="true">
      @if ($hero->main_image)
        <div class="hero__lake"><img src="{{ asset('storage/'.$hero->main_image) }}" alt="" loading="eager" fetchpriority="high"></div>
      @endif
      <div class="hero__strips">
        @foreach ($heroStripImages as $strip)
          <figure><img src="{{ asset('storage/'.$strip->image) }}" alt=""></figure>
        @endforeach
      </div>
    </div>

    <div class="container hero__inner">
      <div class="hero-card">
        @if ($hero->eyebrow)<p class="hero-card__eyebrow">{{ $hero->eyebrow }}</p>@endif
        @if ($hero->title)<h1 class="hero-card__title">{!! nl2br(e($hero->title)) !!}</h1>@endif
        @if ($hero->subtitle)<p class="hero-card__sub">{{ $hero->subtitle }}</p>@endif

        <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">

        <div class="hero-card__actions">
          @if ($hero->cta_1_label)<a class="btn-frame" href="{{ $hero->cta_1_link ?: '#contact' }}"><span>{{ $hero->cta_1_label }}</span></a>@endif
          @if ($hero->cta_2_label)<a class="btn-frame" href="{{ $hero->cta_2_link ?: '#gallery' }}"><span>{{ $hero->cta_2_label }}</span></a>@endif
        </div>
      </div>
    </div>
  </section>
  @endif

  <!-- ticker -->
  @if ($tickerItems->isNotEmpty())
  <div class="hero-ticker">
      <ul>
        @for ($i = 0; $i < 2; $i++)
          @foreach ($tickerItems as $item)
            <li>{{ $item->text }}</li>
            <li aria-hidden="true"><svg class="tick-sep" viewBox="0 0 40 12"><g fill="#d8b25e"><path d="M0 6h11M29 6h11" stroke="#d8b25e" stroke-width="1"/><circle cx="20" cy="6" r="3.2"/><circle cx="13.5" cy="6" r="2"/><circle cx="26.5" cy="6" r="2"/></g></svg></li>
          @endforeach
        @endfor
      </ul>
  </div>
  @endif

  <!-- ============ ABOUT ============ -->
  @if ($about)
  <section class="about" id="about" aria-labelledby="about-title">
    <div class="container about__grid">

      <div class="about__collage">
        @if ($about->image_1)<figure class="collage-b"><img src="{{ asset('storage/'.$about->image_1) }}" alt="" loading="lazy"></figure>@endif
        @if ($about->image_2)<figure class="collage-a"><img src="{{ asset('storage/'.$about->image_2) }}" alt="" loading="lazy"></figure>@endif
        @if ($about->image_3)<figure class="collage-c"><img src="{{ asset('storage/'.$about->image_3) }}" alt="" loading="lazy"></figure>@endif
        @if ($about->badge_image)
          <p class="collage-badge">
            <img src="{{ asset('storage/'.$about->badge_image) }}" alt="">
          </p>
        @endif
      </div>

      <div class="about__panel">
        <img class="ornament" src="{{ asset('assets/about-title-bg.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <h2 id="about-title">{{ $about->heading }}</h2>

        <div class="about__copy">
          {!! $about->body !!}
        </div>

        @if ($about->cta_label)
          <div class="about-btn"><a class="btn-frame" href="{{ $about->cta_link ?: '#services' }}"><span>{{ $about->cta_label }}</span></a></div>
        @endif

        <div class="about-icon">
          <img src="{{ asset('assets/about-icon.svg') }}" width="70" alt="" aria-hidden="true" loading="lazy">
        </div>

      </div>
    </div>
  </section>
  @endif

  <!-- ============ SERVICES ============ -->
  @if ($services->isNotEmpty())
  <section class="services" id="services" aria-labelledby="services-title">
    <img class="services__mascot" src="{{ asset('assets/mascot.png') }}" alt="" aria-hidden="true" loading="lazy">
    <div class="container">
      <div class="services__head">
        <h2 class="section-title title-emboss" id="services-title">Our Services</h2>
        <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
        <p class="section-lead">From planning to a perfect event, we handle every detail so you can celebrate every moment stress-less</p>
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

  <!-- ============ GALLERY ============ -->
  @if ($galleryImages->isNotEmpty())
  <section class="gallery" id="gallery" aria-labelledby="gallery-title">
    <div class="container">
      <h2 class="section-title section-title--cursive title-cream" id="gallery-title">Gallery</h2>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead section-lead--light">A glimpse into the unforgettable celebrations we have crafted, where every detail tells a story.</p>

      @php
        $galleryPositionClasses = ['g1', 'g2 small-thumb', 'g3', 'g4 small-thumb', 'g5', 'g6', 'g7 small-thumb', 'g8 small-thumb'];
      @endphp
      <div class="gallery__grid">
        @foreach ($galleryImages as $index => $image)
          <figure class="{{ $galleryPositionClasses[$index % 8] }}"><img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->alt_text }}" loading="lazy"></figure>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  <!-- ============ BLOGS & STORIES ============ -->
  @if ($blogPosts->isNotEmpty())
  <section class="blogs" id="blogs" aria-labelledby="blogs-title">
    <div class="container">
      <h2 class="section-title title-maroon" id="blogs-title">Blogs &amp; Stories</h2>
      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <p class="section-lead">Explore our latest wedding stories, ideas, and inspiration to make your celebration truly unforgettable.</p>

      <div class="blogs__grid">
        @foreach ($blogPosts as $post)
          <article class="blog-card">
            <figure class="blog-card__media">
              @if ($post->image)<img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" loading="lazy">@endif
            </figure>
            <h3>{{ $post->title }}</h3>
            @if ($post->venue)<p class="venue">{{ $post->venue }}</p>@endif
            <a class="btn-pill" href="#blogs">Read more </a>
          </article>
        @endforeach
      </div>

      <div class="center-action">
        <a class="btn-ornate" href="#blogs"><img src="{{ asset('assets/btn-ornate-red.png') }}" alt="" aria-hidden="true">See More Articles :-</a>
      </div>
    </div>
  </section>
  @endif

  <!-- ============ CONTACT ============ -->
  <section class="contact" id="contact" aria-labelledby="contact-title">
    <div class="container">
      <div class="contact-card">
        <h2 id="contact-title">Say Hi To Your Designers</h2>
        <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">

        <form class="contact-form" method="POST" action="{{ route('contact.submit') }}" novalidate>
          @csrf
          <div class="field-row">
            <div class="field">
              <label for="f-name"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Name</label>
              <input id="f-name" name="name" type="text" placeholder="name" autocomplete="name" value="{{ old('name') }}" required>
            </div>
            <div class="field">
              <label for="f-phone"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Phone</label>
              <input id="f-phone" name="phone" type="tel" placeholder="phone" autocomplete="tel" value="{{ old('phone') }}" required>
            </div>
          </div>

          <div class="field">
            <label for="f-email"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Email</label>
            <input id="f-email" name="email" type="email" placeholder="email" autocomplete="email" value="{{ old('email') }}" required>
          </div>

          <div class="field">
            <label for="f-message"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Message</label>
            <textarea id="f-message" name="message" placeholder="tell us something about ur event" required>{{ old('message') }}</textarea>
          </div>

          <div class="submit-row"><button class="btn-submit" type="submit">Submit</button></div>
          <p class="form-status" role="status" aria-live="polite">
            @if (session('success'))
              {{ session('success') }}
            @elseif ($errors->any())
              Please complete every field.
            @endif
          </p>
        </form>

        <div class="contact-meta">
          <div>
            <h3>Collaboration</h3>
            <a href="mailto:{{ $settings['collaboration_email'] ?? '' }}">{{ $settings['collaboration_email'] ?? '' }}</a>
          </div>
          <div>
            <h3>Careers</h3>
            <a href="mailto:{{ $settings['careers_email'] ?? '' }}">{{ $settings['careers_email'] ?? '' }}</a>
          </div>
        </div>

        <img class="contact-card__flourish" src="{{ asset('assets/flourish.svg') }}" alt="" aria-hidden="true" loading="lazy">
      </div>
    </div>
  </section>


  <!-- ============ TESTIMONIALS ============ -->
  @if ($testimonials->isNotEmpty())
  <section class="testimonials" id="testimonials" aria-labelledby="testi-title">

    <div class="container">

      <h2 class="section-title title-maroon" id="testi-title">Testimonials</h2>

      <img class="ornament" src="{{ asset('assets/ornament-dark.svg') }}" alt="" aria-hidden="true" loading="lazy">

      <p class="section-lead">Celebrate every moment stress-less</p>

      <!-- TESTIMONIAL SLIDER -->
      <div class="testi__track">
        @foreach ($testimonials as $testimonial)
        <div class="testi-card-item">
        <figure class="testi-card">

          <svg class="testi-card__quote" viewBox="0 0 48 40" aria-hidden="true">
            <path d="M0 40C0 18 8 4 22 0l4 9C17 13 12 20 12 28h10v12zm26 0c0-22 8-36 22-40l4 9c-9 4-14 11-14 19h10v12z"/>
          </svg>

          <div class="testi-card__avatar">
            @if ($testimonial->avatar)
              <img src="{{ asset('storage/'.$testimonial->avatar) }}" alt="Portrait of {{ $testimonial->name }}" loading="lazy">
            @endif
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

</main>

<!-- ============ FOOTER ============ -->
<footer class="site-footer">
  <div class="container footer__grid">
    <div class="footer__brand">
      @if (!empty($settings['logo']))
        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'Rajwada Events' }}" loading="lazy">
      @endif
    </div>

    <div class="footer__col footer__col--bulleted">
      <h3>Contact us</h3>
      <div class="contact-info">

        @if (!empty($settings['address']))
        <div class="contact-item">
            <span class="contact-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/>
                    <circle cx="12" cy="9" r="2.5"/>
                </svg>
            </span>
            <span>{{ $settings['address'] }}</span>
        </div>
        @endif

        @if (!empty($settings['whatsapp']))
        <div class="contact-item">
            <span class="contact-icon">
                <span class="contact-icon whatsapp-icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.05 4.91005C18.1331 3.98416 17.0411 3.25002 15.8376 2.75042C14.634 2.25081 13.3431 1.99574 12.04 2.00005C6.58005 2.00005 2.13005 6.45005 2.13005 11.9101C2.13005 13.6601 2.59005 15.3601 3.45005 16.8601L2.05005 22.0001L7.30005 20.6201C8.75005 21.4101 10.38 21.8301 12.04 21.8301C17.5 21.8301 21.9501 17.3801 21.9501 11.9201C21.9501 9.27005 20.92 6.78005 19.05 4.91005ZM12.04 20.1501C10.56 20.1501 9.11005 19.7501 7.84005 19.0001L7.54005 18.8201L4.42005 19.6401L5.25005 16.6001L5.05005 16.2901C4.2276 14.9771 3.79097 13.4593 3.79005 11.9101C3.79005 7.37005 7.49005 3.67005 12.03 3.67005C14.23 3.67005 16.3 4.53005 17.85 6.09005C18.6177 6.85392 19.226 7.7626 19.6397 8.76338C20.0534 9.76417 20.2642 10.8371 20.26 11.9201C20.28 16.4601 16.58 20.1501 12.04 20.1501ZM16.56 13.9901C16.31 13.8701 15.09 13.2701 14.87 13.1801C14.64 13.1001 14.48 13.0601 14.31 13.3001C14.14 13.5501 13.67 14.1101 13.53 14.2701C13.39 14.4401 13.24 14.4601 12.99 14.3301C12.74 14.2101 11.94 13.9401 11 13.1001C10.26 12.4401 9.77005 11.6301 9.62005 11.3801C9.48005 11.1301 9.60005 11.0001 9.73005 10.8701C9.84005 10.7601 9.98005 10.5801 10.1 10.4401C10.22 10.3001 10.27 10.1901 10.35 10.0301C10.43 9.86005 10.39 9.72005 10.33 9.60005C10.27 9.48005 9.77005 8.26005 9.57005 7.76005C9.37005 7.28005 9.16005 7.34005 9.01005 7.33005H8.53005C8.36005 7.33005 8.10005 7.39005 7.87005 7.64005C7.65005 7.89005 7.01005 8.49005 7.01005 9.71005C7.01005 10.9301 7.90005 12.1101 8.02005 12.2701C8.14005 12.4401 9.77005 14.9401 12.25 16.0101C12.84 16.2701 13.3 16.4201 13.66 16.5301C14.25 16.7201 14.79 16.6901 15.22 16.6301C15.7 16.5601 16.69 16.0301 16.89 15.4501C17.1 14.8701 17.1 14.3801 17.03 14.2701C16.96 14.1601 16.81 14.1101 16.56 13.9901Z" fill="#F7ECD7"/>
                    </svg>
              </span>
            </span>
            <span>{{ $settings['whatsapp'] }}</span>
        </div>
        @endif

        @if (!empty($settings['phone']))
        <div class="contact-item">
            <span class="contact-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M6.6 2.5 9 2c.5-.1 1 .2 1.2.7l1.2 3c.2.5.1 1-.3 1.3L9.7 8.3a15.8 15.8 0 0 0 6 6l1.3-1.4c.4-.4.9-.5 1.3-.3l3 1.2c.5.2.8.7.7 1.2l-.5 2.4c-.1.6-.6 1-1.2 1C10.5 18.4 5.6 13.5 5.6 6c0-.6.4-1.1 1-1.2Z"/>
                </svg>
            </span>
            <span>{{ $settings['phone'] }}</span>
        </div>
        @endif

        @if (!empty($settings['email']))
        <div class="contact-item">
            <span class="contact-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="2.5" y="5" width="19" height="14" rx="1"/>
                    <path d="m3 6 9 7 9-7"/>
                </svg>
            </span>
            <span>{{ $settings['email'] }}</span>
        </div>
        @endif

    </div>
    </div>

    <div class="footer__col">
      <h3>Quick links</h3>
      <ul>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#services">Our services</a></li>
        <li><a href="#services">What we do</a></li>
        <li><a href="#blogs">Blogs</a></li>
        <li><a href="#blogs">Success story</a></li>
      </ul>
    </div>

    <div class="footer__col">
      <h3>Useful Links</h3>
      <ul>
        <li><a href="#gallery">Gallery</a></li>
        <li><a href="#services">Our services</a></li>
        <li><a href="#services">What we do</a></li>
        <li><a href="#blogs">Blogs</a></li>
        <li><a href="#blogs">Success story</a></li>
      </ul>
    </div>
  </div>

  <div class="footer__strip">
    <div class="container">
      <p>{{ $settings['footer_copyright'] ?? '' }}</p>
      <p style="display: flex; align-items: center;">Crafted with <img style="margin: 0px 5px;" src="{{ asset('assets/heart.svg') }}" alt=""> by W3care</p>
    </div>
  </div>
</footer>

<script>
(function () {
  'use strict';

  /* ---- mobile navigation ---- */
  var toggle = document.querySelector('.nav-toggle');
  var nav    = document.getElementById('primary-nav');

  toggle.addEventListener('click', function () {
    var open = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', String(!open));
    nav.classList.toggle('is-open', !open);
  });

  nav.addEventListener('click', function (e) {
    if (e.target.tagName === 'A') {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && nav.classList.contains('is-open')) {
      toggle.setAttribute('aria-expanded', 'false');
      nav.classList.remove('is-open');
      toggle.focus();
    }
  });
})();
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
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
  pauseOnHover: true,

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
