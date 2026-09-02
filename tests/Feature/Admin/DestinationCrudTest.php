<?php

use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('the destinations index page loads', function () {
    Destination::factory()->count(3)->create();

    $this->get(route('destinations.index'))->assertOk();
});

test('an image is required to create a destination', function () {
    $response = $this->post(route('destinations.store'), ['name' => 'No image attached']);

    $response->assertSessionHasErrors('image');
    $this->assertDatabaseCount('destinations', 0);
});

test('a destination can be created with an image converted to webp', function () {
    $response = $this->post(route('destinations.store'), [
        'image' => UploadedFile::fake()->image('destination.jpg', 800, 600),
        'name' => 'Jaipur',
        'count_label' => '18+ Celebrations',
        'sort_order' => 1,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('destinations.index'));

    $destination = Destination::where('name', 'Jaipur')->firstOrFail();
    expect($destination->image)->toEndWith('.webp');
    Storage::disk('public')->assertExists($destination->image);
});

test('a destination can be updated without re-uploading', function () {
    $destination = Destination::factory()->create(['name' => 'Old Name']);

    $response = $this->put(route('destinations.update', $destination), [
        'name' => 'New Name',
        'count_label' => $destination->count_label,
        'sort_order' => $destination->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('destinations.index'));
    expect($destination->fresh()->name)->toBe('New Name');
});

test('a destination can be deleted', function () {
    $destination = Destination::factory()->create();

    $this->delete(route('destinations.destroy', $destination))->assertRedirect(route('destinations.index'));

    $this->assertDatabaseMissing('destinations', ['id' => $destination->id]);
});
