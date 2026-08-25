@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Milestone" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Add Milestone</h3>
        </div>

        <form id="timelineItemForm" action="{{ route('timeline-items.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <x-forms.input label="Year (e.g. 2016 or Today)" name="year" required />
            <x-forms.input label="Title" name="title" required />
            <x-forms.textarea label="Description" name="description" required />
            <x-forms.input label="Sort Order" name="sort_order" type="number" value="0" min="0" step="1" />

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Add Milestone</button>
                <a href="{{ route('timeline-items.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/timeline-item-validation.js') }}"></script>
    @endpush
@endsection
