<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use HandlesImageUploads;

    protected array $keys = [
        'site_name', 'site_tagline', 'meta_description', 'logo',
        'phone', 'whatsapp', 'email', 'address',
        'collaboration_email', 'careers_email', 'footer_copyright',
    ];

    public function edit()
    {
        $settings = Setting::pluck('value', 'key');

        return view('settings.edit', ['settings' => $settings]);
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
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeImage($request->file('logo'), 'site', Setting::get('logo'));
        } else {
            unset($validated['logo']);
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully');
    }
}
