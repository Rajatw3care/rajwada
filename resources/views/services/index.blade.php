@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Services" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <a href="{{ route('services.create') }}" class="bg-brand-500 hover:bg-brand-600 inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white">
                Add Service
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[800px]">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Icon</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Title</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Order</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Actions</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <td class="px-5 py-4 sm:px-6">
                                    @if ($service->icon)
                                        <img src="{{ asset('storage/'.$service->icon) }}" alt="" class="h-10 w-10 rounded-lg object-cover">
                                    @endif
                                </td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $service->title }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $service->sort_order }}</p></td>
                                <td class="px-5 py-4 sm:px-6">
                                    @if ($service->is_active)
                                        <span class="rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-400">Active</span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-400">Hidden</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('services.edit', $service) }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">Edit</a>
                                        <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-300 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-8 text-center"><p class="text-gray-500 dark:text-gray-400">No services yet.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($services->hasPages())
            <div class="mt-4">{{ $services->links() }}</div>
        @endif
    </div>
@endsection
