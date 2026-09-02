<?php

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('the videos index page loads', function () {
    Video::factory()->count(3)->create();

    $this->get(route('videos.index'))->assertOk();
});

test('a thumbnail is required to create a video', function () {
    $response = $this->post(route('videos.store'), [
        'category' => 'gallery',
        'title' => 'No thumbnail attached',
        'video_url' => 'https://youtube.com/watch?v=abc',
    ]);

    $response->assertSessionHasErrors('thumbnail');
    $this->assertDatabaseCount('videos', 0);
});

test('a gallery video can be created with a thumbnail converted to webp', function () {
    $response = $this->post(route('videos.store'), [
        'category' => 'gallery',
        'thumbnail' => UploadedFile::fake()->image('thumb.jpg', 640, 360),
        'title' => 'The Royal Vows',
        'tag' => 'Wedding Film',
        'duration' => '04:12',
        'video_url' => 'https://youtube.com/watch?v=abc',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('videos.index'));

    $video = Video::where('title', 'The Royal Vows')->firstOrFail();
    expect($video->thumbnail)->toEndWith('.webp');
    expect($video->category)->toBe('gallery');
});

test('category must be gallery or testimonial', function () {
    $response = $this->post(route('videos.store'), [
        'category' => 'not-valid',
        'thumbnail' => UploadedFile::fake()->image('thumb.jpg'),
        'title' => 'Test Video',
        'video_url' => 'https://youtube.com/watch?v=abc',
    ]);

    $response->assertSessionHasErrors('category');
});

test('a video can be updated without re-uploading a thumbnail', function () {
    $video = Video::factory()->create(['title' => 'Old Title']);

    $response = $this->put(route('videos.update', $video), [
        'category' => $video->category,
        'title' => 'New Title',
        'video_url' => $video->video_url,
        'sort_order' => $video->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('videos.index'));
    expect($video->fresh()->title)->toBe('New Title');
});

test('a video can be deleted', function () {
    $video = Video::factory()->create();

    $this->delete(route('videos.destroy', $video))->assertRedirect(route('videos.index'));

    $this->assertDatabaseMissing('videos', ['id' => $video->id]);
});
