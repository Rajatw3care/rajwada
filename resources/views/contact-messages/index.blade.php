@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Contact Messages" subtitle="Enquiries submitted through the public contact form" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="card-royal overflow-hidden">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[900px]">
                    <thead class="table-header-royal">
                        <tr>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Name</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Phone</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Email</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Received</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Status</p></th>
                            <th class="px-5 py-3.5 text-left sm:px-6"><p class="text-theme-xs font-semibold uppercase tracking-wide text-gold-200">Actions</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactMessages as $message)
                            <tr class="border-b border-gold-300/10 transition hover:bg-brand-50/40 dark:hover:bg-white/[0.02] {{ $message->is_read ? '' : 'bg-gold-50/50 dark:bg-gold-500/5' }}">
                                <td class="px-5 py-4 sm:px-6"><p class="font-medium text-gray-700 text-theme-sm dark:text-gray-300">{{ $message->name }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $message->phone }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $message->email }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $message->created_at->diffForHumans() }}</p></td>
                                <td class="px-5 py-4 sm:px-6">
                                    @if ($message->is_read)
                                        <span class="badge-royal-inactive">Read</span>
                                    @else
                                        <span class="badge-royal-new">&#10022; New</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('contact-messages.show', $message) }}" class="btn-royal-edit">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.05 12a9.95 9.95 0 0 1 19.9 0 9.95 9.95 0 0 1-19.9 0Z" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/></svg>
                                            View
                                        </a>
                                        <x-ui.btn-delete :action="route('contact-messages.destroy', $message)" confirm="Delete this message?" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-5 py-8 text-center"><p class="text-gray-500 dark:text-gray-400">No messages yet.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($contactMessages->hasPages())
            <div class="mt-4">{{ $contactMessages->links() }}</div>
        @endif
    </div>
@endsection
