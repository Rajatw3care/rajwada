<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    use HandlesImageUploads;

    public function index()
    {
        $blogPosts = BlogPost::orderBy('sort_order')->paginate(15);

        return view('blog-posts.index', compact('blogPosts'));
    }

    public function create()
    {
        return view('blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'), 'site/blog');
        }

        BlogPost::create($validated);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post created successfully');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $this->validated($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'), 'site/blog', $blogPost->image);
        }

        $blogPost->update($validated);

        return redirect()->route('blog-posts.index')->with('success', 'Blog post updated successfully');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('blog-posts.index')->with('success', 'Blog post deleted successfully');
    }

    protected function validated(Request $request): array
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'venue' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'body' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
            'sort_order' => 'nullable|integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
