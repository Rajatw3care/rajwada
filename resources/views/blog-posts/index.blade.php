@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Blogs & Stories" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="flex justify-end">
            <a href="{{ route('blog-posts.create') }}" class="bg-brand-500 hover:bg-brand-600 inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium text-white">
                Add Post
            </a>
        </div>

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="max-w-full overflow-x-auto custom-scrollbar">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Image</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Title</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Venue</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Status</p></th>
                            <th class="px-5 py-3 text-left sm:px-6"><p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Actions</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogPosts as $post)
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <td class="px-5 py-4 sm:px-6">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/'.$post->image) }}" alt="" class="h-10 w-14 rounded-lg object-cover">
                                    @endif
                                </td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $post->title }}</p></td>
                                <td class="px-5 py-4 sm:px-6"><p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $post->venue }}</p></td>
                                <td class="px-5 py-4 sm:px-6">
                                    @if ($post->is_active)
                                        <span class="rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700 dark:bg-green-500/15 dark:text-green-400">Published</span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600 dark:bg-gray-700 dark:text-gray-400">Draft</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('blog-posts.edit', $post) }}" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-theme-xs transition hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03]">Edit</a>
                                        <form action="{{ route('blog-posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-red-300 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 dark:border-red-800 dark:hover:bg-red-500/10">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-5 py-8 text-center"><p class="text-gray-500 dark:text-gray-400">No blog posts yet.</p></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($blogPosts->hasPages())
            <div class="mt-4">{{ $blogPosts->links() }}</div>
        @endif
    </div>
@endsection
