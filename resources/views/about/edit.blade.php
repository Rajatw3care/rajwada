@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="About Us" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">About Section</h3>
            </div>

            <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <x-forms.input label="Heading" name="heading" :value="$about->heading" />
                <x-forms.richtext label="Body" name="body" :value="$about->body" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <x-forms.file label="Collage Image 1" name="image_1" :current="$about->image_1" />
                    <x-forms.file label="Collage Image 2" name="image_2" :current="$about->image_2" />
                    <x-forms.file label="Collage Image 3" name="image_3" :current="$about->image_3" />
                </div>

                <x-forms.file label="Badge Image (e.g. '10+ years')" name="badge_image" :current="$about->badge_image" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-forms.input label="Button Label" name="cta_label" :value="$about->cta_label" />
                    <x-forms.input label="Button Link" name="cta_link" :value="$about->cta_link" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white">
                        Save About Content
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
