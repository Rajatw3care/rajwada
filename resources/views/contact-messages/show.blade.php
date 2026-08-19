@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Message from {{ $contactMessage->name }}" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">{{ $contactMessage->name }}</h3>
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

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <a href="{{ route('contact-messages.index') }}" class="btn-royal-cancel">Back to inbox</a>
                <x-ui.btn-delete :action="route('contact-messages.destroy', $contactMessage)" confirm="Delete this message?" />
            </div>
        </div>
    </div>
@endsection
