@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Our Story Timeline" subtitle="Milestones shown on the About Us page" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <x-ui.btn-add href="{{ route('timeline-items.create') }}" label="Add Milestone" />
        </div>

        <div class="card-royal overflow-hidden">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[700px]">
                    <thead class="table-header-royal">
                        <tr>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Year</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Title</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Order</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Actions</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($timelineItems as $item)
                            <tr class="border-b border-gold-300/10 transition hover:bg-brand-50/40 dark:hover:bg-white/[0.02]">
                                <td class="px-5 py-4 sm:px-6"><p class="font-display font-semibold text-brand-700 dark:text-gold-300">{{ $item->year }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-700 text-theme-sm dark:text-gray-300">{{ $item->title }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $item->sort_order }}</p></td>
                                <td class="px-5 py-4 sm:px-6">
                                    <div class="flex items-center gap-2">
                                        <x-ui.btn-edit href="{{ route('timeline-items.edit', $item) }}" />
                                        <x-ui.btn-delete :action="route('timeline-items.destroy', $item)" confirm="Delete this milestone?" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-8 text-center"><p class="text-gray-500 dark:text-gray-400">No timeline items yet.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
