@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit Service" />

    <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Edit: {{ $service->title }}</h3>
        </div>

        <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            @include('services._form')

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="bg-brand-500 hover:bg-brand-600 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white">Update Service</button>
                <a href="{{ route('services.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">Cancel</a>
            </div>
        </form>
    </div>
@endsection
