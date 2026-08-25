@if ($paginator->hasPages())
<nav class="pagination" aria-label="Blog pagination">
  @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
    @if ($page == $paginator->currentPage())
      <a href="{{ $url }}" class="is-active" aria-current="page">{{ $page }}</a>
    @else
      <a href="{{ $url }}">{{ $page }}</a>
    @endif
  @endforeach

  @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="next">Next
      <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M9 5l7 7-7 7"/></svg>
    </a>
  @endif
</nav>
@endif
