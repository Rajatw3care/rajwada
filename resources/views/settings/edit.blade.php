@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Website Settings" subtitle="Branding and contact details used across the site" />

    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">{{ $value }}</x-ui.alert>
        @endsession
        @session('smtp_error')
            <x-ui.alert variant="error">{{ $value }}</x-ui.alert>
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

                <x-ui.section-eyebrow label="SMTP / Email Sending" />
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <x-forms.input label="SMTP Host" name="smtp_host" placeholder="smtp.example.com" :value="$settings['smtp_host'] ?? ''" />
                    <x-forms.input label="SMTP Port" name="smtp_port" type="number" placeholder="587" :value="$settings['smtp_port'] ?? ''" />
                    <x-forms.input label="SMTP Username" name="smtp_username" :value="$settings['smtp_username'] ?? ''" />
                    <x-forms.input
                        label="SMTP Password{{ $hasSmtpPassword ? ' (saved — leave blank to keep it)' : '' }}"
                        name="smtp_password"
                        type="password"
                        placeholder="{{ $hasSmtpPassword ? '••••••••' : '' }}"
                        value=""
                    />
                    <x-forms.select label="Encryption" name="smtp_encryption" :options="['tls' => 'TLS (recommended)', 'ssl' => 'SSL', 'none' => 'None']" :selected="$settings['smtp_encryption'] ?? 'tls'" />
                    <x-forms.input label="\"From\" Email Address" name="mail_from_address" type="email" placeholder="no-reply@rajwadaevents.com" :value="$settings['mail_from_address'] ?? ''" />
                    <x-forms.input label="\"From\" Name" name="mail_from_name" :value="$settings['mail_from_name'] ?? ''" />
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    New contact-form enquiries are emailed to the "Email" address set under Contact Details above, once SMTP is configured here.
                </p>

                <x-ui.section-eyebrow label="Footer" />
                <x-forms.input label="Footer Copyright Text" name="footer_copyright" :value="$settings['footer_copyright'] ?? ''" />

                <div class="border-t border-gold-300/15 pt-5">
                    <button type="submit" class="btn-royal-add">Save Settings</button>
                </div>
            </form>
        </div>

        <div class="form-card-royal">
            <div class="form-card-royal__header">
                <h3 class="font-display text-lg font-semibold text-brand-700 dark:text-gold-200">Send a Test Email</h3>
            </div>

            <form action="{{ route('settings.test-email') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <p class="text-sm text-gray-500 dark:text-gray-400">Save your SMTP settings above first, then send a test email here to confirm they work.</p>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end">
                    <div class="flex-1">
                        <x-forms.input label="Send test email to" name="test_email" type="email" required placeholder="you@example.com" :value="auth()->user()->email ?? ''" />
                    </div>
                    <button type="submit" class="btn-royal-add">Send Test Email</button>
                </div>
            </form>
        </div>
    </div>
@endsection
