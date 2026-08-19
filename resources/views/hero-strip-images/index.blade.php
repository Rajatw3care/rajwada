@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hero Strip Images" subtitle="The row of photos beside the homepage hero" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <x-ui.btn-add href="{{ route('hero-strip-images.create') }}" label="Add Image" />
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-5">
            @forelse ($heroStripImages as $image)
                <div class="grid-card-royal p-3">
                    <img src="{{ asset('storage/'.$image->image) }}" alt="" class="mb-3 h-32 w-full rounded-lg object-cover">
                    <p class="mb-2 text-xs text-gray-500 dark:text-gray-400">Order: {{ $image->sort_order }}</p>
                    <x-ui.btn-delete :action="route('hero-strip-images.destroy', $image)" confirm="Remove this image?" class="w-full [&>button]:w-full [&>button]:justify-center" />
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No strip images yet.</p>
            @endforelse
        </div>
    </div>
@endsection
