@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Add Ceremony" />

    <div class="form-card-royal">
        <div class="form-card-royal__header">
            <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Add Ceremony</h3>
        </div>

        <form action="{{ route('ceremonies.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            @include('ceremonies._form')

            <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                <button type="submit" class="btn-royal-add">Add Ceremony</button>
                <a href="{{ route('ceremonies.index') }}" class="btn-royal-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection
