<?php

use App\Models\SuccessStory;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('the success stories index page loads', function () {
    SuccessStory::factory()->count(3)->create();

    $this->get(route('success-stories.index'))->assertOk();
});

test('an image is required to create a success story', function () {
    $response = $this->post(route('success-stories.store'), ['title' => 'No image attached']);

    $response->assertSessionHasErrors('image');
    $this->assertDatabaseCount('success_stories', 0);
});

test('a success story can be created with an image converted to webp', function () {
    $response = $this->post(route('success-stories.store'), [
        'image' => UploadedFile::fake()->image('story.jpg', 800, 600),
        'location' => 'Jaipur, Rajasthan',
        'title' => 'A Royal Union at Jaipur',
        'description' => 'An elephant-led baraat before Hawa Mahal.',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('success-stories.index'));

    $story = SuccessStory::where('title', 'A Royal Union at Jaipur')->firstOrFail();
    expect($story->image)->toEndWith('.webp');
    Storage::disk('public')->assertExists($story->image);
});

test('a success story can be updated without re-uploading', function () {
    $story = SuccessStory::factory()->create(['title' => 'Old Title']);

    $response = $this->put(route('success-stories.update', $story), [
        'title' => 'New Title',
        'location' => $story->location,
        'description' => $story->description,
        'sort_order' => $story->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('success-stories.index'));
    expect($story->fresh()->title)->toBe('New Title');
});

test('a success story can be deleted', function () {
    $story = SuccessStory::factory()->create();

    $this->delete(route('success-stories.destroy', $story))->assertRedirect(route('success-stories.index'));

    $this->assertDatabaseMissing('success_stories', ['id' => $story->id]);
});
