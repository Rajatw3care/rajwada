@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="About Us" subtitle="The story behind Rajwada Events" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">About Section</h3>
            </div>

            <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <x-ui.section-eyebrow label="Story" />
                <x-forms.input label="Heading" name="heading" :value="$about->heading" />
                <x-forms.richtext label="Body" name="body" :value="$about->body" />

                <x-ui.section-eyebrow label="Collage" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                    <x-forms.file label="Collage Image 1" name="image_1" :current="$about->image_1" />
                    <x-forms.file label="Collage Image 2" name="image_2" :current="$about->image_2" />
                    <x-forms.file label="Collage Image 3" name="image_3" :current="$about->image_3" />
                </div>
                <x-forms.file label="Badge Image (e.g. '10+ years')" name="badge_image" :current="$about->badge_image" />

                <x-ui.section-eyebrow label="Call to Action" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Button Label" name="cta_label" :value="$about->cta_label" />
                    <x-forms.input label="Button Link" name="cta_link" :value="$about->cta_link" />
                </div>

                <div class="border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Save About Content</button>
                </div>
            </form>
        </div>
    </div>
@endsection
