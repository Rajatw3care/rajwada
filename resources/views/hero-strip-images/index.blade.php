@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Hero Strip Images" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <a href="{{ route('hero-strip-images.create') }}" class="bg-brand-500 hover:bg-brand-600 inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white">
                Add Image
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-5">
            @forelse ($heroStripImages as $image)
                <div class="rounded-xl border border-gray-200 bg-white p-3 dark:border-gray-800 dark:bg-white/[0.03]">
                    <img src="{{ asset('storage/'.$image->image) }}" alt="" class="mb-3 h-32 w-full rounded-lg object-cover">
                    <p class="mb-2 text-xs text-gray-500 dark:text-gray-400">Order: {{ $image->sort_order }}</p>
                    <form action="{{ route('hero-strip-images.destroy', $image) }}" method="POST" onsubmit="return confirm('Remove this image?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full rounded-lg border border-red-300 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-500/10">
                            Remove
                        </button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No strip images yet.</p>
            @endforelse
        </div>
    </div>
@endsection
