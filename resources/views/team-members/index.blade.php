@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Our Team" subtitle="People shown on the About Us page" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <x-ui.btn-add href="{{ route('team-members.create') }}" label="Add Team Member" />
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($teamMembers as $member)
                <div class="grid-card-royal p-5 text-center">
                    <div class="mx-auto h-20 w-20 overflow-hidden rounded-full border-2 border-gold-300/50 bg-brand-50 dark:bg-white/5">
                        @if ($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" alt="" class="h-full w-full object-cover">
                        @endif
                    </div>
                    <h3 class="mt-3 font-display text-base font-semibold text-gray-800 dark:text-white/90">{{ $member->name }}</h3>
                    @if ($member->role)
                        <p class="text-sm text-gold-600 dark:text-gold-400">{{ $member->role }}</p>
                    @endif
                    <div class="mt-2"><x-ui.status-badge :active="$member->is_active" /></div>
                    <div class="mt-3 flex items-center justify-center gap-2">
                        <x-ui.btn-edit href="{{ route('team-members.edit', $member) }}" />
                        <x-ui.btn-delete :action="route('team-members.destroy', $member)" />
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 dark:text-gray-400">No team members yet &mdash; add your first one above.</div>
            @endforelse
        </div>
    </div>
@endsection
