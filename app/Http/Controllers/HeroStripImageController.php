<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\HeroStripImage;
use Illuminate\Http\Request;

class HeroStripImageController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $heroStripImages = HeroStripImage::orderBy('sort_order')->get();

        return view('hero-strip-images.index', compact('heroStripImages'));
    }

    public function create()
    {
        return view('hero-strip-images.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:4096',
            'sort_order' => 'nullable|integer',
        ]);
        // These are small decorative strip thumbnails (never displayed wider than
        // ~450px even on retina), so cap them far tighter than the 2000px/285KB
        // default meant for full-bleed hero backgrounds.
        $validated['image'] = $this->storeImage($request->file('image'), 'site/hero', maxDimension: 1000, targetBytes: 51200);

        HeroStripImage::create($validated);

        return redirect()->route('hero-strip-images.index')->with('success', 'Hero strip image added successfully');
    }

    public function destroy(HeroStripImage $heroStripImage)
    {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($heroStripImage->image);
        $heroStripImage->delete();

        return redirect()->route('hero-strip-images.index')->with('success', 'Hero strip image removed successfully');
    }
}
