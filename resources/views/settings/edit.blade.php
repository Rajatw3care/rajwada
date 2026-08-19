@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Site Settings" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="border-b border-gray-200 px-6 py-4 dark:border-gray-800">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Site Settings</h3>
            </div>

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <x-forms.file label="Logo" name="logo" :current="$settings['logo'] ?? null" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-forms.input label="Site Name" name="site_name" :value="$settings['site_name'] ?? ''" />
                    <x-forms.input label="Tagline" name="site_tagline" :value="$settings['site_tagline'] ?? ''" />
                </div>

                <x-forms.textarea label="Meta Description" name="meta_description" :value="$settings['meta_description'] ?? ''" :rows="2" />

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <x-forms.input label="Phone" name="phone" :value="$settings['phone'] ?? ''" />
                    <x-forms.input label="WhatsApp" name="whatsapp" :value="$settings['whatsapp'] ?? ''" />
                    <x-forms.input label="Email" name="email" type="email" :value="$settings['email'] ?? ''" />
                    <x-forms.input label="Address" name="address" :value="$settings['address'] ?? ''" />
                    <x-forms.input label="Collaboration Email" name="collaboration_email" type="email" :value="$settings['collaboration_email'] ?? ''" />
                    <x-forms.input label="Careers Email" name="careers_email" type="email" :value="$settings['careers_email'] ?? ''" />
                </div>

                <x-forms.input label="Footer Copyright Text" name="footer_copyright" :value="$settings['footer_copyright'] ?? ''" />

                <div class="pt-2">
                    <button type="submit" class="bg-brand-500 hover:bg-brand-600 flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
