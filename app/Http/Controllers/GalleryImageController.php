<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $galleryImages = GalleryImage::orderBy('sort_order')->paginate(15);

        return view('gallery-images.index', compact('galleryImages'));
    }

    public function create()
    {
        return view('gallery-images.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:4096',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->storeImage($request->file('image'), 'site/gallery');

        GalleryImage::create($validated);

        return redirect()->route('gallery-images.index')->with('success', 'Gallery image added successfully');
    }

    public function edit(GalleryImage $galleryImage)
    {
        return view('gallery-images.edit', compact('galleryImage'));
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:4096',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'), 'site/gallery', $galleryImage->image);
        }

        $galleryImage->update($validated);

        return redirect()->route('gallery-images.index')->with('success', 'Gallery image updated successfully');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        $galleryImage->delete();

        return redirect()->route('gallery-images.index')->with('success', 'Gallery image deleted successfully');
    }
}
