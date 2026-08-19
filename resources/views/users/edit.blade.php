@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Edit User" />

    <div class="space-y-6">
        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">
                    Edit: {{ $user->name }}
                </h3>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4 p-6">
                @csrf
                @method('PUT')

                <x-forms.input label="Name" name="name" :value="$user->name" required />
                <x-forms.input label="Email" name="email" :value="$user->email" required />

                <div class="flex items-center gap-3 border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Update User</button>
                    <a href="{{ route('users.index') }}" class="btn-royal-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
