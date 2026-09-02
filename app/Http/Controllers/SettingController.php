<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Mail\TestSmtpEmail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class SettingController extends Controller
{
    use HandlesImageUploads;

    protected array $keys = [
        'site_name', 'site_tagline', 'meta_description', 'logo',
        'phone', 'whatsapp', 'email', 'address',
        'collaboration_email', 'careers_email', 'footer_copyright',
        'office_hours', 'map_embed_url',
        'social_instagram', 'social_facebook', 'social_youtube', 'social_pinterest',
        'share_facebook', 'share_twitter', 'share_whatsapp', 'share_email',
        'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption',
        'mail_from_address', 'mail_from_name',
    ];

    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        $settings->forget('smtp_password'); // never send the (encrypted) password value back to the browser

        return view('settings.edit', [
            'settings' => $settings,
            'hasSmtpPassword' => filled(Setting::get('smtp_password')),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'collaboration_email' => 'nullable|email|max:255',
            'careers_email' => 'nullable|email|max:255',
            'footer_copyright' => 'nullable|string|max:255',
            'office_hours' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|string|max:2000',
            'social_instagram' => 'nullable|string|max:255',
            'social_facebook' => 'nullable|string|max:255',
            'social_youtube' => 'nullable|string|max:255',
            'social_pinterest' => 'nullable|string|max:255',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_encryption' => 'nullable|in:tls,ssl,none',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeImage($request->file('logo'), 'site', Setting::get('logo'));
        } else {
            unset($validated['logo']);
        }

        foreach (['share_facebook', 'share_twitter', 'share_whatsapp', 'share_email'] as $shareKey) {
            $validated[$shareKey] = $request->boolean($shareKey) ? '1' : '0';
        }

        // leave the stored (encrypted) password alone unless a new one was typed
        if (blank($validated['smtp_password'] ?? null)) {
            unset($validated['smtp_password']);
        } else {
            $validated['smtp_password'] = Crypt::encryptString($validated['smtp_password']);
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully');
    }

    public function sendTestEmail(Request $request)
    {
        $validated = $request->validate([
            'test_email' => 'required|email',
        ]);

        try {
            Mail::to($validated['test_email'])->send(new TestSmtpEmail);
        } catch (\Throwable $e) {
            return redirect()->route('settings.edit')->with('smtp_error', 'Could not send test email: '.$e->getMessage());
        }

        return redirect()->route('settings.edit')->with('success', 'Test email sent to '.$validated['test_email'].' — check the inbox (and spam folder).');
    }
}
