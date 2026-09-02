<?php

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->actingAs(User::factory()->create());
});

test('guests are redirected to login', function () {
    auth()->logout();

    $this->get(route('services.index'))->assertRedirect('/login');
});

test('the services index page loads', function () {
    Service::factory()->count(3)->create();

    $this->get(route('services.index'))->assertOk();
});

test('a service can be created with an icon upload, converted to webp', function () {
    $response = $this->post(route('services.store'), [
        'title' => 'Venue Booking',
        'description' => 'We find the perfect venue for your celebration.',
        'icon' => UploadedFile::fake()->image('icon.jpg', 200, 200),
        'sort_order' => 1,
        'is_active' => '1',
        'show_on_homepage' => '1',
    ]);

    $response->assertRedirect(route('services.index'));

    $service = Service::where('title', 'Venue Booking')->firstOrFail();
    expect($service->icon)->toEndWith('.webp');
    Storage::disk('public')->assertExists($service->icon);
});

test('title is required to create a service', function () {
    $response = $this->post(route('services.store'), []);

    $response->assertSessionHasErrors('title');
    $this->assertDatabaseCount('services', 0);
});

test('a service can be updated without re-uploading an icon', function () {
    $service = Service::factory()->create(['title' => 'Old Title']);

    $response = $this->put(route('services.update', $service), [
        'title' => 'New Title',
        'description' => $service->description,
        'sort_order' => $service->sort_order,
        'is_active' => '1',
    ]);

    $response->assertRedirect(route('services.index'));
    expect($service->fresh()->title)->toBe('New Title');
});

test('a service can be deleted', function () {
    $service = Service::factory()->create();

    $this->delete(route('services.destroy', $service))->assertRedirect(route('services.index'));

    $this->assertDatabaseMissing('services', ['id' => $service->id]);
});
