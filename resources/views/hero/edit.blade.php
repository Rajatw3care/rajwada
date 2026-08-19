@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hero Section" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Hero Content</h3>
            </div>

            <form action="{{ route('hero.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <x-forms.file label="Main Background Image" name="main_image" :current="$hero->main_image" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-forms.input label="Eyebrow" name="eyebrow" :value="$hero->eyebrow" />
                    <x-forms.input label="Title" name="title" :value="$hero->title" />
                </div>

                <x-forms.input label="Subtitle" name="subtitle" :value="$hero->subtitle" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-forms.input label="Button 1 Label" name="cta_1_label" :value="$hero->cta_1_label" />
                    <x-forms.input label="Button 1 Link" name="cta_1_link" :value="$hero->cta_1_link" />
                    <x-forms.input label="Button 2 Label" name="cta_2_label" :value="$hero->cta_2_label" />
                    <x-forms.input label="Button 2 Link" name="cta_2_link" :value="$hero->cta_2_link" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white">
                        Save Hero Content
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
