<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureMailFromSettings();
    }

    /**
     * Let the admin's Settings > SMTP fields override the .env mail config,
     * so mail can be configured from the CMS without touching the server.
     * Falls back to .env silently if the settings table isn't migrated yet
     * (e.g. during the very first `php artisan migrate`) or SMTP host isn't set.
     */
    protected function configureMailFromSettings(): void
    {
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }

            $host = Setting::get('smtp_host');

            if (blank($host)) {
                return;
            }

            $encryption = Setting::get('smtp_encryption', 'tls');
            $password = Setting::get('smtp_password');

            // Laravel/Symfony Mailer don't take literal "tls"/"ssl" strings here:
            // 'smtps' forces implicit TLS (typically port 465); null lets Symfony
            // negotiate STARTTLS opportunistically (the normal case for port 587).
            $scheme = $encryption === 'ssl' ? 'smtps' : null;

            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => $host,
                'mail.mailers.smtp.port' => (int) Setting::get('smtp_port', 587),
                'mail.mailers.smtp.username' => Setting::get('smtp_username'),
                'mail.mailers.smtp.password' => filled($password) ? Crypt::decryptString($password) : null,
                'mail.mailers.smtp.scheme' => $scheme,
                'mail.from.address' => Setting::get('mail_from_address') ?: config('mail.from.address'),
                'mail.from.name' => Setting::get('mail_from_name') ?: config('mail.from.name'),
            ]);
        } catch (\Throwable $e) {
            // never let a mail-config problem break the whole app (e.g. mid-migration,
            // a corrupted encrypted password, or a fresh install with no DB yet)
            report($e);
        }
    }
}
