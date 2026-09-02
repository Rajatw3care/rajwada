<?php

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('the blog posts index page loads', function () {
    BlogPost::factory()->count(3)->create();

    $this->get(route('blog-posts.index'))->assertOk();
});

test('a blog post can be created with an image, category, tags and featured flag', function () {
    $response = $this->post(route('blog-posts.store'), [
        'title' => 'A Royal Wedding at Lalgarh Palace',
        'venue' => 'Lalgarh Palace, Bikaner',
        'excerpt' => 'A short excerpt about the celebration.',
        'body' => '<p>The full story of the celebration.</p>',
        'image' => UploadedFile::fake()->image('post.jpg', 800, 500),
        'category' => 'Real Weddings',
        'tags' => 'Palace Wedding, Bikaner',
        'sort_order' => 1,
        'is_active' => '1',
        'is_featured' => '1',
    ]);

    $response->assertRedirect(route('blog-posts.index'));

    $post = BlogPost::where('title', 'A Royal Wedding at Lalgarh Palace')->firstOrFail();
    expect($post->image)->toEndWith('.webp');
    expect($post->category)->toBe('Real Weddings');
    expect($post->is_featured)->toBeTrue();
    expect($post->slug)->not->toBeEmpty();
});

test('title is required to create a blog post', function () {
    $response = $this->post(route('blog-posts.store'), []);

    $response->assertSessionHasErrors('title');
});

test('a blog post can be updated', function () {
    $post = BlogPost::factory()->create(['title' => 'Old Title']);

    $response = $this->put(route('blog-posts.update', $post), [
        'title' => 'Updated Title',
        'venue' => $post->venue,
        'excerpt' => $post->excerpt,
        'body' => $post->body,
        'sort_order' => $post->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('blog-posts.index'));
    expect($post->fresh()->title)->toBe('Updated Title');
});

test('a blog post can be deleted', function () {
    $post = BlogPost::factory()->create();

    $this->delete(route('blog-posts.destroy', $post))->assertRedirect(route('blog-posts.index'));

    $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
});
