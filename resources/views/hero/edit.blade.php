@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Homepage Hero" subtitle="The first thing visitors see" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Hero Content</h3>
            </div>

            <form action="{{ route('hero.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <x-ui.section-eyebrow label="Background" />
                <x-forms.file label="Main Background Image" name="main_image" :current="$hero->main_image" />

                <x-ui.section-eyebrow label="Headline" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Eyebrow" name="eyebrow" :value="$hero->eyebrow" />
                    <x-forms.input label="Title" name="title" :value="$hero->title" />
                </div>
                <x-forms.input label="Subtitle" name="subtitle" :value="$hero->subtitle" />

                <x-ui.section-eyebrow label="Buttons" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Button 1 Label" name="cta_1_label" :value="$hero->cta_1_label" />
                    <x-forms.input label="Button 1 Link" name="cta_1_link" :value="$hero->cta_1_link" />
                    <x-forms.input label="Button 2 Label" name="cta_2_label" :value="$hero->cta_2_label" />
                    <x-forms.input label="Button 2 Link" name="cta_2_link" :value="$hero->cta_2_link" />
                </div>

                <div class="border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Save Hero Content</button>
                </div>
            </form>
        </div>
    </div>
@endsection
