@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="About Us" subtitle="The story behind Rajwada Events" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="card-royal p-5">
            <p class="mb-3 text-sm font-medium text-gray-500 dark:text-gray-400">Other sections of the About Us page:</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('vision-mission.edit') }}" class="btn-royal-cancel">Vision & Mission</a>
                <a href="{{ route('timeline-items.index') }}" class="btn-royal-cancel">Our Story Timeline</a>
                <a href="{{ route('why-choose-items.index') }}" class="btn-royal-cancel">Why Choose Us</a>
                <a href="{{ route('partners.index') }}" class="btn-royal-cancel">Our Partners</a>
                <a href="{{ route('team-members.index') }}" class="btn-royal-cancel">Our Team</a>
                <a href="{{ route('ceremonies.index') }}" class="btn-royal-cancel">Wedding Ceremonies</a>
            </div>
        </div>

        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">About Section</h3>
            </div>

            <form id="aboutForm" action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <x-ui.section-eyebrow label="Page Banner" />
                <x-forms.file label="About Us Page Banner Image" name="page_banner_image" :current="$about->page_banner_image" required />

                <x-ui.section-eyebrow label="Company Overview" />
                <x-forms.input label="Heading" name="heading" :value="$about->heading" required />
                <x-forms.richtext label="Body" name="body" :value="$about->body" required />

                <x-ui.section-eyebrow label="Collage" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <x-forms.file label="Collage Image 1" name="image_1" :current="$about->image_1" required />
                    <x-forms.file label="Collage Image 2" name="image_2" :current="$about->image_2" required />
                    <x-forms.file label="Collage Image 3" name="image_3" :current="$about->image_3" required />
                </div>
                <x-forms.file label="Badge Image (e.g. '10+ years')" name="badge_image" :current="$about->badge_image" required />

                <x-ui.section-eyebrow label="Call to Action" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Button Label" name="cta_label" :value="$about->cta_label" required maxlength="15" />
                    <x-forms.input label="Button Link" name="cta_link" :value="$about->cta_link" readonly />
                </div>

                <div class="border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Save About Content</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/about-validation.js') }}"></script>
    @endpush
@endsection
