{{-- Expects: $settings --}}
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
            <a href="tel:{{ preg_replace('/\s+/', '', $settings['phone']) }}">{{ $settings['phone'] }}</a>
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
            <a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
        </div>
        @endif

    </div>
    </div>

    <div class="footer__col">
      <h3>Quick links</h3>
      <ul>
        <li><a href="{{ route('gallery') }}">Gallery</a></li>
        <li><a href="{{ route('services') }}">Our services</a></li>
        <li><a href="{{ route('services') }}">Wedding Services</a></li>
        <li><a href="{{ route('blogs') }}">Blogs</a></li>
        <li><a href="{{ route('success-story') }}">Success story</a></li>
      </ul>
    </div>

    <div class="footer__col">
      <h3>Useful Links</h3>
      <ul>
        <li><a href="{{ route('about') }}#team">Our Team</a></li>
        <li><a href="{{ route('about') }}#why-us">Why Choose Us</a></li>
        <li><a href="{{ route('about') }}#ceremonies">Ceremonies</a></li>
        <li><a href="{{ route('gallery') }}">Our Portfolio</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li>
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
