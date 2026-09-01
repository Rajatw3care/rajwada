<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesImageUploads;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    use HandlesImageUploads;

    private const SHARE_URL_PATTERN = '/^(https?:\/\/[^\s]+|mailto:[^\s@]+@[^\s@]+\.[^\s@]+)$/i';

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

        $validated['published_at'] ??= now();

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

        $validated['published_at'] ??= $blogPost->published_at ?? now();

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
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',
            'share_facebook_url' => ['nullable', 'max:500', 'regex:'.self::SHARE_URL_PATTERN],
            'share_twitter_url' => ['nullable', 'max:500', 'regex:'.self::SHARE_URL_PATTERN],
            'share_whatsapp_url' => ['nullable', 'max:500', 'regex:'.self::SHARE_URL_PATTERN],
            'share_email_url' => ['nullable', 'email', 'max:255'],
        ], [
            'share_facebook_url.regex' => 'Enter a valid URL (starting with http://, https://, or mailto:).',
            'share_twitter_url.regex' => 'Enter a valid URL (starting with http://, https://, or mailto:).',
            'share_whatsapp_url.regex' => 'Enter a valid URL (starting with http://, https://, or mailto:).',
            'share_email_url.email' => 'Enter a valid email address.',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        return $validated;
    }
}
