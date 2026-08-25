<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $successStories = SuccessStory::orderBy('sort_order')->paginate(15);

        return view('success-stories.index', compact('successStories'));
    }

    public function create()
    {
        return view('success-stories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|max:4096',
            'location' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['image'] = $this->storeImage($request->file('image'), 'site/success-stories');

        SuccessStory::create($validated);

        return redirect()->route('success-stories.index')->with('success', 'Success story created successfully');
    }

    public function edit(SuccessStory $successStory)
    {
        return view('success-stories.edit', compact('successStory'));
    }

    public function update(Request $request, SuccessStory $successStory)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|max:4096',
            'location' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'), 'site/success-stories', $successStory->image);
        }

        $successStory->update($validated);

        return redirect()->route('success-stories.index')->with('success', 'Success story updated successfully');
    }

    public function destroy(SuccessStory $successStory)
    {
        $successStory->delete();

        return redirect()->route('success-stories.index')->with('success', 'Success story deleted successfully');
    }
}
