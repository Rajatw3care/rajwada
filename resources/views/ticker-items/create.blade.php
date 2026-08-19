@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Ticker Item" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Add Item</h3>
        </div>

        <form action="{{ route('ticker-items.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <x-forms.input label="Text" name="text" required />
            <x-forms.input label="Sort Order" name="sort_order" type="number" value="0" />

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Add Item</button>
                <a href="{{ route('ticker-items.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
