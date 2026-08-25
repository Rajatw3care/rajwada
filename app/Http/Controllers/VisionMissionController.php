<?php

namespace App\Http\Controllers;

use App\Models\AboutContent;
use Illuminate\Http\Request;

class VisionMissionController extends Controller
{
    public function edit()
    {
        $about = AboutContent::firstOrNew(['id' => 1]);

        return view('vision-mission.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = AboutContent::firstOrNew(['id' => 1]);

        $validated = $request->validate([
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'core_values' => 'nullable|string|max:255',
        ]);

        $about->fill($validated);
        $about->save();

        return redirect()->route('vision-mission.edit')->with('success', 'Vision & Mission updated successfully');
    }
}
