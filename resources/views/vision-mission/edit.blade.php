@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Vision & Mission" subtitle="The story behind Rajwada Events" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Vision & Mission</h3>
            </div>

            <form id="visionMissionForm" action="{{ route('vision-mission.update') }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <x-forms.textarea label="Our Vision" name="vision" :value="$about->vision" :rows="3" required maxlength="200" />
                <x-forms.textarea label="Our Mission" name="mission" :value="$about->mission" :rows="3" required maxlength="200" />
                <x-forms.tags-input label="Core Values" name="core_values" :value="$about->core_values" required :max="6" />

                <div class="border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Save Vision & Mission</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/vision-mission-validation.js') }}"></script>
    @endpush
@endsection
