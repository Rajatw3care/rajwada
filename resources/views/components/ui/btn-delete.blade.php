@props(['action', 'confirm' => 'Delete this item? This cannot be undone.'])

<form action="{{ $action }}" method="POST" onsubmit="return confirm('{{ $confirm }}')" {{ $attributes }}>
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-royal-delete">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6h14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10 11v6M14 11v6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <span>Delete</span>
    </button>
</form>
