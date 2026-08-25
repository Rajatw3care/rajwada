@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Partner" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Edit: {{ $partner->name }}</h3>
        </div>

        <form id="partnerForm" action="{{ route('partners.update', $partner) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            @include('partners._form')

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Update Partner</button>
                <a href="{{ route('partners.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('js/partner-validation.js') }}"></script>
    @endpush
@endsection
