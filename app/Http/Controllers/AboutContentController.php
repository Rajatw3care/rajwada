<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    use HandlesImageUploads;

    public function edit()
    {
        $about = AboutContent::firstOrNew(['id' => 1]);

        return view('about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutContent::firstOrNew(['id' => 1]);

        $validated = $request->validate([
            'heading' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image_1' => 'nullable|image|max:4096',
            'image_2' => 'nullable|image|max:4096',
            'image_3' => 'nullable|image|max:4096',
            'badge_image' => 'nullable|image|max:2048',
            'cta_label' => 'nullable|string|max:100',
            'cta_link' => 'nullable|string|max:255',
        ]);

        foreach (['image_1', 'image_2', 'image_3', 'badge_image'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $this->storeImage($request->file($field), 'site/about', $about->$field);
            } else {
                unset($validated[$field]);
            }
        }

        $about->fill($validated);
        $about->save();

        return redirect()->route('about.edit')->with('success', 'About section updated successfully');
    }
}
