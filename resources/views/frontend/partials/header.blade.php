{{-- Expects: $settings, $active ('home' or 'about') --}}
<header class="site-header">
  <div class="container">
    <a class="brand" href="{{ route('home') }}" aria-label="{{ $settings['site_name'] ?? 'Rajwada Events' }} — home">
      @if (!empty($settings['logo']))
        <img src="{{ asset('storage/'.$settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'Rajwada Events' }}" width="180" height="120">
      @endif
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Toggle navigation menu">
      <span></span><span></span><span></span>
    </button>

    <nav class="main-nav" id="primary-nav" aria-label="Primary">
      <ul>
        <li><a href="{{ route('home') }}" @if(($active ?? 'home') === 'home') aria-current="page" @endif>Home</a></li>
        <li><a href="{{ route('about') }}" @if(($active ?? '') === 'about') aria-current="page" @endif>About Us</a></li>
        <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
        <li><a href="{{ route('home') }}#services">What We Do</a></li>
        <li><a href="{{ route('home') }}#blogs">Blogs</a></li>
        <li><a href="{{ route('home') }}#blogs">Stories</a></li>
        <li><a href="{{ route('home') }}#testimonials">Testimonials</a></li>
        <li><a href="{{ route('home') }}#contact">Contact&nbsp; Us</a></li>
        <li><a href="{{ route('home') }}#contact">Enquire Now</a></li>
      </ul>
    </nav>
  </div>
</header>
