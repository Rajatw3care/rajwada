<?php

use App\Models\RatingStat;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('the rating stats index page loads', function () {
    RatingStat::factory()->count(3)->create();

    $this->get(route('rating-stats.index'))->assertOk();
});

test('a rating stat can be created', function () {
    $response = $this->post(route('rating-stats.store'), [
        'icon' => '⭐',
        'number' => '4.9/5',
        'label' => 'Average Client Rating',
        'sort_order' => 1,
    ]);

    $response->assertRedirect(route('rating-stats.index'));
    $this->assertDatabaseHas('rating_stats', ['number' => '4.9/5', 'label' => 'Average Client Rating']);
});

test('number and label are required to create a rating stat', function () {
    $response = $this->post(route('rating-stats.store'), []);

    $response->assertSessionHasErrors(['number', 'label']);
});

test('a rating stat can be updated', function () {
    $stat = RatingStat::factory()->create(['label' => 'Old Label']);

    $response = $this->put(route('rating-stats.update', $stat), [
        'number' => $stat->number,
        'label' => 'New Label',
        'sort_order' => $stat->sort_order,
    ]);

    $response->assertRedirect(route('rating-stats.index'));
    expect($stat->fresh()->label)->toBe('New Label');
});

test('a rating stat can be deleted', function () {
    $stat = RatingStat::factory()->create();

    $this->delete(route('rating-stats.destroy', $stat))->assertRedirect(route('rating-stats.index'));

    $this->assertDatabaseMissing('rating_stats', ['id' => $stat->id]);
});
