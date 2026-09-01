@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Website Settings" subtitle="Branding and contact details used across the site" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession

        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Site Settings</h3>
            </div>

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <x-ui.section-eyebrow label="Branding" />
                <x-forms.file label="Logo" name="logo" :current="$settings['logo'] ?? null" />

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Site Name" name="site_name" :value="$settings['site_name'] ?? ''" />
                    <x-forms.input label="Tagline" name="site_tagline" :value="$settings['site_tagline'] ?? ''" />
                </div>

                <x-forms.textarea label="Meta Description" name="meta_description" :value="$settings['meta_description'] ?? ''" :rows="2" />

                <x-ui.section-eyebrow label="Contact Details" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Phone" name="phone" :value="$settings['phone'] ?? ''" />
                    <x-forms.input label="WhatsApp" name="whatsapp" :value="$settings['whatsapp'] ?? ''" />
                    <x-forms.input label="Email" name="email" type="email" :value="$settings['email'] ?? ''" />
                    <x-forms.input label="Address" name="address" :value="$settings['address'] ?? ''" />
                    <x-forms.input label="Collaboration Email" name="collaboration_email" type="email" :value="$settings['collaboration_email'] ?? ''" />
                    <x-forms.input label="Careers Email" name="careers_email" type="email" :value="$settings['careers_email'] ?? ''" />
                    <x-forms.input label="Office Hours" name="office_hours" :value="$settings['office_hours'] ?? ''" />
                </div>

                <x-ui.section-eyebrow label="Contact Page Map" />
                <x-forms.textarea label="Google Maps Embed URL" name="map_embed_url" :value="$settings['map_embed_url'] ?? ''" :rows="2" />

                <x-ui.section-eyebrow label="Social Links" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="Instagram URL" name="social_instagram" :value="$settings['social_instagram'] ?? ''" />
                    <x-forms.input label="Facebook URL" name="social_facebook" :value="$settings['social_facebook'] ?? ''" />
                    <x-forms.input label="YouTube URL" name="social_youtube" :value="$settings['social_youtube'] ?? ''" />
                    <x-forms.input label="Pinterest URL" name="social_pinterest" :value="$settings['social_pinterest'] ?? ''" />
                </div>

                <x-ui.section-eyebrow label="Blog Share Buttons" />
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                    <x-forms.checkbox label="Facebook" name="share_facebook" :checked="($settings['share_facebook'] ?? '1') !== '0'" />
                    <x-forms.checkbox label="X / Twitter" name="share_twitter" :checked="($settings['share_twitter'] ?? '1') !== '0'" />
                    <x-forms.checkbox label="WhatsApp" name="share_whatsapp" :checked="($settings['share_whatsapp'] ?? '1') !== '0'" />
                    <x-forms.checkbox label="Email" name="share_email" :checked="($settings['share_email'] ?? '1') !== '0'" />
                </div>

                <x-ui.section-eyebrow label="Footer" />
                <x-forms.input label="Footer Copyright Text" name="footer_copyright" :value="$settings['footer_copyright'] ?? ''" />

                <div class="border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
