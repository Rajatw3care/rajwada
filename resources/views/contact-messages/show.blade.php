@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Message from {{ $contactMessage->name }}" />

    <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">{{ $contactMessage->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $contactMessage->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="space-y-4 p-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-medium uppercase text-gray-400">Phone</p>
                    <a href="tel:{{ $contactMessage->phone }}" class="text-sm text-gray-700 dark:text-gray-300">{{ $contactMessage->phone }}</a>
                </div>
                <div>
                    <p class="text-xs font-medium uppercase text-gray-400">Email</p>
                    <a href="mailto:{{ $contactMessage->email }}" class="text-sm text-gray-700 dark:text-gray-300">{{ $contactMessage->email }}</a>
                </div>
            </div>

            <div>
                <p class="mb-1 text-xs font-medium uppercase text-gray-400">Message</p>
                <p class="whitespace-pre-line text-sm text-gray-700 dark:text-gray-300">{{ $contactMessage->message }}</p>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <a href="{{ route('contact-messages.index') }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">Back to inbox</a>
                <form action="{{ route('contact-messages.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-300 px-5 py-3 text-sm font-medium text-red-600 hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-500/10">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
