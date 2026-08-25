@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Why Choose Us Item" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Add Item</h3>
        </div>

        <form id="whyChooseItemForm" action="{{ route('why-choose-items.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @include('why-choose-items._form')

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Add Item</button>
                <a href="{{ route('why-choose-items.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/why-choose-item-validation.js') }}"></script>
    @endpush
@endsection
