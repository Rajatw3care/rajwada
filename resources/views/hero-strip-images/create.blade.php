@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Hero Strip Image" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Add Image</h3>
        </div>

        <form action="{{ route('hero-strip-images.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf

            <x-forms.file label="Image" name="image" required />
            <x-forms.input label="Sort Order" name="sort_order" type="number" value="0" />

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Add Image</button>
                <a href="{{ route('hero-strip-images.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
