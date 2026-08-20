@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Our Partners" subtitle="Logos shown in the partners slider on About Us" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <x-ui.btn-add href="{{ route('partners.create') }}" label="Add Partner" />
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
            @forelse ($partners as $partner)
                <div class="grid-card-royal p-4 text-center">
                    <div class="flex h-16 items-center justify-center">
                        <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" class="max-h-14 max-w-full object-contain">
                    </div>
                    <p class="mt-2 truncate text-sm font-medium text-gray-700 dark:text-gray-300">{{ $partner->name }}</p>
                    <div class="mt-1"><x-ui.status-badge :active="$partner->is_active" /></div>
                    <div class="mt-3 flex items-center justify-center gap-2">
                        <x-ui.btn-edit href="{{ route('partners.edit', $partner) }}" />
                        <x-ui.btn-delete :action="route('partners.destroy', $partner)" />
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">No partners yet &mdash; add your first one above.</div>
            @endforelse
        </div>
    </div>
@endsection
