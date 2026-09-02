<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $settings['site_name'] ?? 'Rajwada Events' }} — {{ $settings['site_tagline'] ?? 'The Rajwada Creators' }}</title>
<meta name="description" content="{{ $settings['meta_description'] ?? '' }}">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

</head>

<body>

@include('frontend.partials.header', ['active' => 'home'])

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
    <img class="services__mascot" src="{{ asset('assets/mascot.webp') }}" alt="" aria-hidden="true" loading="lazy">
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

        <h2 class="section-title section-title--cursive title-cream" id="gallery-title">
            Gallery
        </h2>

        <img
            class="ornament"
            src="{{ asset('assets/ornament-light.svg') }}"
            alt=""
            aria-hidden="true"
            loading="lazy"
        >

        <p class="section-lead section-lead--light">
            A glimpse into the unforgettable celebrations we have crafted,
            where every detail tells a story.
        </p>


        {{-- =========================================================
             DESKTOP GALLERY - EXACTLY 4 COLUMNS
        ========================================================== --}}

        @php
            $images = $galleryImages->values();

            $desktopColumns = [
                collect(),
                collect(),
                collect(),
                collect(),
            ];

            foreach ($images as $index => $image) {
                $desktopColumns[$index % 4]->push($image);
            }
        @endphp


        <div class="gallery__grid_scroll hide-mobile">

            @foreach ($desktopColumns as $columnIndex => $columnImages)

                @if ($columnImages->isNotEmpty())

                    <div class="gallery-column">

                        <div class="gallery-track {{ $columnIndex % 2 === 0 ? 'scroll-up' : 'scroll-down' }}">

                            {{-- Rendered twice (real set + aria-hidden duplicate) so the
                                 scrollUp/scrollDown keyframes (0% -> translateY(-50%) and back)
                                 always land on an identical duplicate frame — no visible jump. --}}
                            @foreach ([false, true] as $isDuplicateSet)
                                @foreach ($columnImages as $imageIndex => $image)

                                    @php
                                        /*
                                         * Column 1: Big, Small, Big, Small...
                                         * Column 2: Small, Big, Small, Big...
                                         * Column 3: Big, Small, Big, Small...
                                         * Column 4: Small, Big, Small, Big...
                                         */
                                        $isSmall = (($columnIndex + $imageIndex) % 2 === 1);
                                    @endphp

                                    <figure class="{{ $isSmall ? 'small-thumb' : '' }}" @if ($isDuplicateSet) aria-hidden="true" @endif>
                                        <img
                                            src="{{ asset('storage/' . $image->image) }}"
                                            alt="{{ $isDuplicateSet ? '' : ($image->alt_text ?? 'Gallery image') }}"
                                            loading="lazy"
                                        >
                                    </figure>

                                @endforeach
                            @endforeach

                        </div>

                    </div>

                @endif

            @endforeach

        </div>


        {{-- =========================================================
             MOBILE GALLERY - EXACTLY 3 COLUMNS
        ========================================================== --}}

        @php
            $mobileColumns = [
                collect(),
                collect(),
                collect(),
            ];

            foreach ($images as $index => $image) {
                $mobileColumns[$index % 3]->push($image);
            }
        @endphp


        <div class="gallery__grid_scroll hide">

            @foreach ($mobileColumns as $columnIndex => $columnImages)

                @if ($columnImages->isNotEmpty())

                    <div class="gallery-column">

                        <div class="gallery-track {{ $columnIndex % 2 === 0 ? 'scroll-up' : 'scroll-down' }}">

                            {{-- Rendered twice (real set + aria-hidden duplicate) so the
                                 scrollUp/scrollDown keyframes (0% -> translateY(-50%) and back)
                                 always land on an identical duplicate frame — no visible jump. --}}
                            @foreach ([false, true] as $isDuplicateSet)
                                @foreach ($columnImages as $imageIndex => $image)

                                    @php
                                        /*
                                         * Mobile pattern:
                                         * Column 1: Big, Small, Big, Small...
                                         * Column 2: Small, Big, Small, Big...
                                         * Column 3: Big, Small, Big, Small...
                                         */
                                        $isSmall = (($columnIndex + $imageIndex) % 2 === 1);
                                    @endphp

                                    <figure class="{{ $isSmall ? 'small-thumb' : '' }}" @if ($isDuplicateSet) aria-hidden="true" @endif>
                                        <img
                                            src="{{ asset('storage/' . $image->image) }}"
                                            alt="{{ $isDuplicateSet ? '' : ($image->alt_text ?? 'Gallery image') }}"
                                            loading="lazy"
                                        >
                                    </figure>

                                @endforeach
                            @endforeach

                        </div>

                    </div>

                @endif

            @endforeach

        </div>


        {{-- =========================================================
             VIEW ALL
        ========================================================== --}}

        <div class="center-action">
            <a class="btn-ornate btn-ornate--gold" href="#gallery">
                <img
                    src="{{ asset('assets/btn-ornate-gold.webp') }}"
                    alt=""
                    aria-hidden="true"
                >
                View all
            </a>
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
            <a class="btn-pill" href="{{ route('blog.show', $post->slug) }}">Read more </a>
          </article>
        @endforeach
      </div>

      <div class="center-action">
        <a class="btn-ornate" href="{{ route('blogs') }}"><img src="{{ asset('assets/btn-ornate-red.webp') }}" alt="" aria-hidden="true">See More Articles :-</a>
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
            <div class="field @error('name') has-error @enderror">
              <label for="f-name"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Name</label>
              <input id="f-name" name="name" type="text" placeholder="name" autocomplete="name" value="{{ old('name') }}" required minlength="2" maxlength="255" data-label="Name">
              @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="field @error('phone') has-error @enderror">
              <label for="f-phone"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Phone</label>
              <input id="f-phone" name="phone" type="tel" inputmode="numeric" placeholder="phone" autocomplete="tel" value="{{ old('phone') }}" required pattern="[0-9]{7,15}" minlength="7" maxlength="15" data-label="Phone">
              @error('phone')<span class="field-error">{{ $message }}</span>@enderror
            </div>
          </div>

          <div class="field @error('email') has-error @enderror">
            <label for="f-email"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Email</label>
            <input id="f-email" name="email" type="email" placeholder="email" autocomplete="email" value="{{ old('email') }}" required maxlength="255" data-label="Email">
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="field @error('message') has-error @enderror">
            <label for="f-message"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2l2.9 6.3 6.9.8-5.1 4.7 1.4 6.8L12 17.2 5.9 20.6l1.4-6.8L2.2 9.1l6.9-.8z"/></svg> Message</label>
            <textarea id="f-message" name="message" placeholder="tell us something about ur event" required minlength="5" maxlength="5000" data-label="Message">{{ old('message') }}</textarea>
            @error('message')<span class="field-error">{{ $message }}</span>@enderror
          </div>

          <div class="submit-row"><button class="btn-submit" type="submit">Submit</button></div>
          <p class="form-status @if(session('success')) is-success @elseif($errors->any()) is-error @endif" role="status" aria-live="polite">
            @if (session('success'))
              {{ session('success') }}
            @elseif ($errors->any())
              Please check the highlighted fields below.
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

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

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
