@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Why Choose Us" subtitle="The reasons couples trust Rajwada Events" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <x-ui.btn-add href="{{ route('why-choose-items.create') }}" label="Add Item" />
        </div>

        <div class="card-royal overflow-hidden">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[800px]">
                    <thead class="table-header-royal">
                        <tr>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Icon</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Title</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Status</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Actions</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($whyChooseItems as $item)
                            <tr class="border-b border-gold-300/10 transition hover:bg-brand-50/40 dark:hover:bg-white/[0.02]">
                                <td class="px-5 py-4 sm:px-6">
                                    @if ($item->icon)
                                        <img src="{{ asset('storage/'.$item->icon) }}" alt="" class="h-10 w-10 rounded-lg border border-gold-300/40 object-cover">
                                    @endif
                                </td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-700 text-theme-sm dark:text-gray-300">{{ $item->title }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><x-ui.status-badge :active="$item->is_active" /></td>
                                <td class="px-5 py-4 sm:px-6">
                                    <div class="flex items-center gap-2">
                                        <x-ui.btn-edit href="{{ route('why-choose-items.edit', $item) }}" />
                                        <x-ui.btn-delete :action="route('why-choose-items.destroy', $item)" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-8 text-center"><p class="text-gray-500 dark:text-gray-400">No items yet.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
