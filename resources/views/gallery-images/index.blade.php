@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Gallery" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <a href="{{ route('gallery-images.create') }}" class="bg-brand-500 hover:bg-brand-600 inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white">
                Add Image
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
            @forelse ($galleryImages as $image)
                <div class="rounded-xl border border-gray-200 bg-white p-3 dark:border-gray-800 dark:bg-white/[0.03]">
                    <img src="{{ asset('storage/'.$image->image) }}" alt="{{ $image->alt_text }}" class="mb-3 h-32 w-full rounded-lg object-cover">
                    <p class="mb-1 truncate text-xs text-gray-500 dark:text-gray-400" title="{{ $image->alt_text }}">{{ $image->alt_text ?: '—' }}</p>
                    <p class="mb-2 text-xs text-gray-400">
                        Order {{ $image->sort_order }} ·
                        @if ($image->is_active) <span class="text-green-600">Active</span> @else <span class="text-gray-400">Hidden</span> @endif
                    </p>
                    <div class="flex gap-2">
                        <a href="{{ route('gallery-images.edit', $image) }}" class="flex-1 rounded-lg border border-gray-300 px-3 py-1.5 text-center text-xs font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/[0.03]">Edit</a>
                        <form action="{{ route('gallery-images.destroy', $image) }}" method="POST" onsubmit="return confirm('Delete this image?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full rounded-lg border border-red-300 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-500/10">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No gallery images yet.</p>
            @endforelse
        </div>

        @if ($galleryImages->hasPages())
            <div class="mt-4">{{ $galleryImages->links() }}</div>
        @endif
    </div>
@endsection
