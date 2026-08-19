@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Users" subtitle="Admin accounts with access to this panel" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">
                {{ $value }}
            </x-ui.alert>
        @endsession

        <div class="card-royal overflow-hidden">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[1102px]">
                    <thead class="table-header-royal">
                        <tr>
                            <th class="px-5 py-3.5 text-left sm:px-6">
                                <p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Name</p>
                            </th>
                            <th class="px-5 py-3.5 text-left sm:px-6">
                                <p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Email</p>
                            </th>
                            <th class="px-5 py-3.5 text-left sm:px-6">
                                <p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Created At</p>
                            </th>
                            <th class="px-5 py-3.5 text-left sm:px-6">
                                <p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Updated At</p>
                            </th>
                            <th class="px-5 py-3.5 text-left sm:px-6">
                                <p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Actions</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-b border-gold-300/10 transition hover:bg-brand-50/40 dark:hover:bg-white/[0.02]">
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="font-medium text-gray-700 text-theme-sm dark:text-gray-300">{{ $user->name }}</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->email }}</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->created_at }}</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->updated_at }}</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <x-ui.btn-edit href="{{ route('users.edit', $user) }}" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-8 text-center">
                                    <p class="text-gray-500 dark:text-gray-400">No users found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($users->hasPages())
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
