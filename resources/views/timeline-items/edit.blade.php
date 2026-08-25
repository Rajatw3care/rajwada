@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Milestone" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Edit: {{ $timelineItem->title }}</h3>
        </div>

        <form id="timelineItemForm" action="{{ route('timeline-items.update', $timelineItem) }}" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <x-forms.input label="Year (e.g. 2016 or Today)" name="year" :value="$timelineItem->year" required />
            <x-forms.input label="Title" name="title" :value="$timelineItem->title" required />
            <x-forms.textarea label="Description" name="description" :value="$timelineItem->description" required />
            <x-forms.input label="Sort Order" name="sort_order" type="number" :value="$timelineItem->sort_order" min="0" step="1" />

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Update Milestone</button>
                <a href="{{ route('timeline-items.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/timeline-item-validation.js') }}"></script>
    @endpush
@endsection
