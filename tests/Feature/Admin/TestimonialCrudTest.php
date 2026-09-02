<?php

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('the testimonials index page loads', function () {
    Testimonial::factory()->count(3)->create();

    $this->get(route('testimonials.index'))->assertOk();
});

test('a testimonial can be created with event label, rating and featured flag', function () {
    $response = $this->post(route('testimonials.store'), [
        'name' => 'Vikram Chauhan',
        'message' => 'Rajwada Events made our wedding effortless.',
        'avatar' => UploadedFile::fake()->image('avatar.jpg', 300, 300),
        'event_label' => 'Royal Family Wedding — Jaipur',
        'rating' => 5,
        'sort_order' => 1,
        'is_active' => '1',
        'is_featured' => '1',
    ]);

    $response->assertRedirect(route('testimonials.index'));

    $testimonial = Testimonial::where('name', 'Vikram Chauhan')->firstOrFail();
    expect($testimonial->avatar)->toEndWith('.webp');
    expect($testimonial->rating)->toBe(5);
    expect($testimonial->is_featured)->toBeTrue();
});

test('name and message are required to create a testimonial', function () {
    $response = $this->post(route('testimonials.store'), []);

    $response->assertSessionHasErrors(['name', 'message']);
});

test('a testimonial can be updated', function () {
    $testimonial = Testimonial::factory()->create(['name' => 'Old Name']);

    $response = $this->put(route('testimonials.update', $testimonial), [
        'name' => 'New Name',
        'message' => $testimonial->message,
        'rating' => 4,
        'sort_order' => $testimonial->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('testimonials.index'));
    expect($testimonial->fresh()->name)->toBe('New Name');
});

test('a testimonial can be deleted', function () {
    $testimonial = Testimonial::factory()->create();

    $this->delete(route('testimonials.destroy', $testimonial))->assertRedirect(route('testimonials.index'));

    $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
});
