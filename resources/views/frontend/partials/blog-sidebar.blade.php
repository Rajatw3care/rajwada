{{-- Expects: $categories, $recentPosts, $popularTags --}}
<aside aria-label="Blog sidebar">

  <div class="widget search-widget">
    <h3 class="widget__title">Search</h3>
    <form role="search" action="{{ route('blogs') }}" method="GET">
      <label class="sr-only" for="blog-search">Search blogs</label>
      <input id="blog-search" type="search" name="q" placeholder="Search articles…" value="{{ $search ?? request('q') }}">
      <button type="submit" aria-label="Search">
        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
      </button>
    </form>
  </div>

  @if ($categories->isNotEmpty())
  <div class="widget">
    <h3 class="widget__title">Blog Categories</h3>
    <ul class="cat-list">
      @foreach ($categories as $category => $count)
        <li><a href="{{ route('blogs') }}">{{ $category }} <span class="count">{{ $count }}</span></a></li>
      @endforeach
    </ul>
  </div>
  @endif

  @if ($recentPosts->isNotEmpty())
  <div class="widget">
    <h3 class="widget__title">Recent Posts</h3>
    @foreach ($recentPosts as $post)
      <div class="recent-post">
        <div class="recent-post__thumb">
          @if ($post->image)<img src="{{ asset('storage/'.$post->image) }}" alt="" loading="lazy">@endif
        </div>
        <div class="recent-post__body">
          <h4><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h4>
          <p class="date">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/></svg>
            {{ optional($post->published_at ?? $post->created_at)->format('d M Y') }}
          </p>
        </div>
      </div>
    @endforeach
  </div>
  @endif

  @if (!empty($popularTags))
  <div class="widget">
    <h3 class="widget__title">Popular Tags</h3>
    <div class="tag-list">
      @foreach ($popularTags as $tag)
        <a href="{{ route('blogs') }}">{{ $tag }}</a>
      @endforeach
    </div>
  </div>
  @endif

  <div class="widget widget-cta">
    <h3 class="widget__title">Plan With Us</h3>
    <p>Ready to start planning your own royal celebration? Our team is one message away.</p>
    <a class="btn-frame" href="{{ route('contact') }}"><span>Enquire Now</span></a>
  </div>

</aside>
