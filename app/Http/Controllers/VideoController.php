<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $videos = Video::orderBy('category')->orderBy('sort_order')->paginate(15);

        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request, required: true);
        $validated['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'site/videos');

        Video::create($validated);

        return redirect()->route('videos.index')->with('success', 'Video added successfully');
    }

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeImage($request->file('thumbnail'), 'site/videos', $video->thumbnail);
        }

        $video->update($validated);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully');
    }

    protected function validated(Request $request, bool $required = false): array
    {
        $validated = $request->validate([
            'category' => 'required|in:gallery,testimonial',
            'thumbnail' => ($required ? 'required' : 'nullable').'|image|max:4096',
            'title' => 'required|string|max:255',
            'tag' => 'nullable|string|max:100',
            'duration' => 'nullable|string|max:20',
            'video_url' => 'required|string|max:500',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
