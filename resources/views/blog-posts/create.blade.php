@extends(request()->boolean('modal') ? 'layouts.fragment' : 'layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Blog Post" subtitle="Publish a new wedding story" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Add Blog Post</h3>
        </div>

        <form action="{{ route('blog-posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @include('blog-posts._form')

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l1.6 5.2a2 2 0 0 0 1.2 1.2L20 10l-5.2 1.6a2 2 0 0 0-1.2 1.2L12 18l-1.6-5.2a2 2 0 0 0-1.2-1.2L4 10l5.2-1.6a2 2 0 0 0 1.2-1.2L12 2z"/></svg>
                    Save Post
                </button>
                <a href="{{ route('blog-posts.index') }}" data-modal-close class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
