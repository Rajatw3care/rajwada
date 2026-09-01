<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact Us — {{ $settings['site_name'] ?? 'Rajwada Events' }} | {{ $settings['site_tagline'] ?? 'The Royal Creators' }}</title>
<meta name="description" content="Connect with {{ $settings['site_name'] ?? 'Rajwada Events' }} for wedding and event planning inquiries. Reach us by phone, email or WhatsApp, or send us your event details directly.">
<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

@include('frontend.partials.header', ['active' => 'contact'])

<main id="top">

  <!-- ============ HERO BANNER ============ -->
  <section class="page-banner" aria-label="Contact {{ $settings['site_name'] ?? 'Rajwada Events' }}">
    <div class="page-banner__media" aria-hidden="true">
      <img src="{{ asset('assets/bg-contact.webp') }}" alt="" loading="eager" fetchpriority="high">
    </div>
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="container page-banner__inner">
      <p class="page-banner__eyebrow">{{ $settings['site_tagline'] ?? 'The Royal Creators' }}</p>
      <h1>Contact Us</h1>
      <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a><span>/</span><span aria-current="page">Contact Us</span>
      </nav>
    </div>
  </section>

  <!-- ============ TRUST STRIP ============ -->
  <section class="trust-strip" aria-label="Why connect with {{ $settings['site_name'] ?? 'Rajwada Events' }}">
    <div class="container">
      <ul>
        <li><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg> Response within 24 hours</li>
        <li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 12l5 5L20 6"/></svg> 10+ years of expertise</li>
        <li><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M8 3v3M16 3v3"/></svg> Transparent planning</li>
        <li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 8.6c0 5.4-8.8 10.4-8.8 10.4S3.2 14 3.2 8.6a4.6 4.6 0 0 1 8.8-1.9 4.6 4.6 0 0 1 8.8 1.9Z"/></svg> End-to-end execution</li>
      </ul>
    </div>
  </section>

  <!-- ============ GET IN TOUCH ============ -->
  <section class="contact-page" id="inquiry-form" aria-labelledby="contact-title">
    <div class="container">
      <div class="contact-layout">

        <div class="contact-card">
          <h2>Send Us Your Inquiry</h2>
          <img class="ornament" src="{{ asset('assets/ornament-light.svg') }}" alt="" aria-hidden="true" loading="lazy">

          <form class="contact-form inquiry-form" method="POST" action="{{ route('contact.submit') }}" novalidate>
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

          <img class="contact-card__flourish" src="{{ asset('assets/flourish.svg') }}" alt="" aria-hidden="true" loading="lazy">
        </div>

        <aside class="side-contact-details" aria-label="Contact details">

          <div class="widget widget-cta">
            <h3 class="widget__title">Contact Details</h3>
            <div class="contact-info" style="max-width:none;">

              @if (!empty($settings['address']))
              <div class="contact-item">
                <span class="contact-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/></svg></span>
                <span>{{ $settings['address'] }}</span>
              </div>
              @endif

              @if (!empty($settings['phone']))
              <div class="contact-item">
                <span class="contact-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 2.5 9 2c.5-.1 1 .2 1.2.7l1.2 3c.2.5.1 1-.3 1.3L9.7 8.3a15.8 15.8 0 0 0 6 6l1.3-1.4c.4-.4.9-.5 1.3-.3l3 1.2c.5.2.8.7.7 1.2l-.5 2.4c-.1.6-.6 1-1.2 1C10.5 18.4 5.6 13.5 5.6 6c0-.6.4-1.1 1-1.2Z"/></svg></span>
                <span>{{ $settings['phone'] }}</span>
              </div>
              @endif

              @if (!empty($settings['email']))
              <div class="contact-item">
                <span class="contact-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="2.5" y="5" width="19" height="14" rx="1"/><path d="m3 6 9 7 9-7"/></svg></span>
                <span>{{ $settings['email'] }}</span>
              </div>
              @endif

              @if (!empty($settings['office_hours']))
              <div class="contact-item">
                <span class="contact-icon"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg></span>
                <span>{{ $settings['office_hours'] }}</span>
              </div>
              @endif

            </div>
          </div>

          <div class="widget">
            <h3 class="widget__title">Quick Connect</h3>
            <div class="quick-connect">
              @if (!empty($settings['phone']))
              <a class="btn-frame" href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}">
                <span><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6.6 2.5 9 2c.5-.1 1 .2 1.2.7l1.2 3c.2.5.1 1-.3 1.3L9.7 8.3a15.8 15.8 0 0 0 6 6l1.3-1.4c.4-.4.9-.5 1.3-.3l3 1.2c.5.2.8.7.7 1.2l-.5 2.4c-.1.6-.6 1-1.2 1C10.5 18.4 5.6 13.5 5.6 6c0-.6.4-1.1 1-1.2Z"/></svg> Call Now</span>
              </a>
              @endif
              @if (!empty($settings['email']))
              <a class="btn-frame" href="mailto:{{ $settings['email'] }}">
                <span><svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2.5" y="5" width="19" height="14" rx="1"/><path d="m3 6 9 7 9-7"/></svg> Email Us</span>
              </a>
              @endif
              @if (!empty($settings['whatsapp']))
              <a class="btn-frame whatsup" href="https://wa.me/{{ preg_replace('/\D/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener">
                <span><svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor" stroke="none"><path d="M12.04 2C6.6 2 2.16 6.45 2.16 11.9c0 1.83.5 3.53 1.36 5l-1.4 4.15 4.3-1.36a9.9 9.9 0 0 0 5.62 1.75c5.44 0 9.87-4.45 9.87-9.9 0-2.65-1.03-5.13-2.9-7A9.83 9.83 0 0 0 12.04 2Z"/></svg> WhatsApp Chat</span>
              </a>
              @endif
            </div>
          </div>

          @if (!empty($settings['social_instagram']) || !empty($settings['social_facebook']) || !empty($settings['social_youtube']) || !empty($settings['social_pinterest']))
          <div class="widget">
            <h3 class="widget__title">Follow Us</h3>
            <div class="social-widget-row">
              @if (!empty($settings['social_instagram']))
              <a class="share-icon" href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} on Instagram">
                <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.3" cy="6.7" r="1"/></svg>
              </a>
              @endif
              @if (!empty($settings['social_facebook']))
              <a class="share-icon" href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} on Facebook">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13.5 21v-7.6h2.6l.4-3H13.5V8.4c0-.87.24-1.46 1.5-1.46h1.6V4.24C16.3 4.17 15.4 4.1 14.35 4.1c-2.2 0-3.7 1.34-3.7 3.8v2.5H8v3h2.65V21h2.85Z"/></svg>
              </a>
              @endif
              @if (!empty($settings['social_youtube']))
              <a class="share-icon" href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} on YouTube">
                <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2.5" y="5.5" width="19" height="13" rx="3"/><path d="m10.5 9 5 3-5 3V9Z"/></svg>
              </a>
              @endif
              @if (!empty($settings['social_pinterest']))
              <a class="share-icon" href="{{ $settings['social_pinterest'] }}" target="_blank" rel="noopener" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} on Pinterest">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12.03 2C6.5 2 3.7 5.9 3.7 9.15c0 1.97.75 3.72 2.36 4.37.26.1.5 0 .58-.29l.24-.94c.08-.3.05-.4-.17-.66-.47-.55-.77-1.27-.77-2.28 0-2.94 2.2-5.57 5.73-5.57 3.13 0 4.84 1.9 4.84 4.45 0 3.36-1.48 6.19-3.68 6.19-1.22 0-2.13-1-1.84-2.24.35-1.48 1.03-3.08 1.03-4.15 0-.96-.51-1.76-1.58-1.76-1.25 0-2.26 1.3-2.26 3.03 0 1.1.37 1.85.37 1.85l-1.5 6.35c-.44 1.87-.07 4.16-.03 4.4.02.14.2.18.28.07.12-.15 1.63-2.02 2.14-3.88.15-.53.85-3.32.85-3.32.42.8 1.65 1.5 2.96 1.5 3.9 0 6.54-3.55 6.54-8.3 0-3.6-3.05-6.95-7.68-6.95Z"/></svg>
              </a>
              @endif
            </div>
          </div>
          @endif

        </aside>
      </div>
    </div>
  </section>

  <!-- ============ FIND US ============ -->
  <section class="map-section" id="map" aria-labelledby="map-title">
    <div class="">
      <div class="map-frame">
        <iframe
          src="{{ $settings['map_embed_url'] ?? 'https://www.google.com/maps?q=Jaipur,Rajasthan,India&output=embed' }}"
          title="{{ $settings['site_name'] ?? 'Rajwada Events' }} office location on Google Maps" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

</main>

@include('frontend.partials.footer')

@include('frontend.partials.nav-scripts')

</body>
</html>
