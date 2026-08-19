<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\HeroContent;
use Illuminate\Http\Request;

class HeroContentController extends Controller
{
    use HandlesImageUploads;

    public function edit()
    {
        $hero = HeroContent::firstOrNew(['id' => 1]);

        return view('hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $hero = HeroContent::firstOrNew(['id' => 1]);

        $validated = $request->validate([
            'eyebrow' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'main_image' => 'nullable|image|max:4096',
            'cta_1_label' => 'nullable|string|max:100',
            'cta_1_link' => 'nullable|string|max:255',
            'cta_2_label' => 'nullable|string|max:100',
            'cta_2_link' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $this->storeImage($request->file('main_image'), 'site/hero', $hero->main_image);
        } else {
            unset($validated['main_image']);
        }

        $hero->fill($validated);
        $hero->save();

        return redirect()->route('hero.edit')->with('success', 'Hero section updated successfully');
    }
}
