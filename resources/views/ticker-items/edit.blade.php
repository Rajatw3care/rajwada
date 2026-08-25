@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Ticker Item" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Edit Item</h3>
        </div>

        <form id="tickerItemForm" action="{{ route('ticker-items.update', $tickerItem) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <x-forms.input label="Text" name="text" :value="$tickerItem->text" required maxlength="30" />
            <x-forms.input label="Sort Order" name="sort_order" type="number" :value="$tickerItem->sort_order" min="0" step="1" />

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Update Item</button>
                <a href="{{ route('ticker-items.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/ticker-item-validation.js') }}"></script>
    @endpush
@endsection
