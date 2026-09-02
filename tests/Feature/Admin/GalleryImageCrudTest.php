<?php

use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('the gallery images index page loads', function () {
    GalleryImage::factory()->count(3)->create();

    $this->get(route('gallery-images.index'))->assertOk();
});

test('an image is required to create a gallery image', function () {
    $response = $this->post(route('gallery-images.store'), ['alt_text' => 'No file attached']);

    $response->assertSessionHasErrors('image');
    $this->assertDatabaseCount('gallery_images', 0);
});

test('a gallery image can be created with category and title, converted to webp', function () {
    $response = $this->post(route('gallery-images.store'), [
        'image' => UploadedFile::fake()->image('photo.jpg', 400, 300),
        'alt_text' => 'A royal wedding moment',
        'title' => 'Royal Jaimala',
        'category' => 'royal',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('gallery-images.index'));

    $image = GalleryImage::where('title', 'Royal Jaimala')->firstOrFail();
    expect($image->image)->toEndWith('.webp');
    expect($image->category)->toBe('royal');
    Storage::disk('public')->assertExists($image->image);
});

test('category must be one of the known filter values', function () {
    $response = $this->post(route('gallery-images.store'), [
        'image' => UploadedFile::fake()->image('photo.jpg'),
        'category' => 'not-a-real-category',
    ]);

    $response->assertSessionHasErrors('category');
});

test('a gallery image can be updated without re-uploading', function () {
    $image = GalleryImage::factory()->create(['alt_text' => 'Old alt text']);

    $response = $this->put(route('gallery-images.update', $image), [
        'alt_text' => 'New alt text',
        'category' => $image->category,
        'sort_order' => $image->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('gallery-images.index'));
    expect($image->fresh()->alt_text)->toBe('New alt text');
});

test('a gallery image can be deleted', function () {
    $image = GalleryImage::factory()->create();

    $this->delete(route('gallery-images.destroy', $image))->assertRedirect(route('gallery-images.index'));

    $this->assertDatabaseMissing('gallery_images', ['id' => $image->id]);
});
