@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Ceremony" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Edit: {{ $ceremony->title }}</h3>
        </div>

        <form id="ceremonyForm" action="{{ route('ceremonies.update', $ceremony) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            @include('ceremonies._form')

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Update Ceremony</button>
                <a href="{{ route('ceremonies.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/ceremony-validation.js') }}"></script>
    @endpush
@endsection
