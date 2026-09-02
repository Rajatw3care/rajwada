<?php

use App\Models\BlogPost;
use App\Models\Destination;
use App\Models\GalleryImage;
use App\Models\RatingStat;
use App\Models\Service;
use App\Models\SuccessStory;
use App\Models\Testimonial;
use App\Models\Video;

test('homepage loads successfully with no content', function () {
    $this->get(route('home'))->assertOk();
});

test('homepage loads successfully with content and shows only homepage-flagged services', function () {
    Service::factory()->create(['title' => 'Homepage Teaser Service', 'show_on_homepage' => true, 'is_active' => true]);
    Service::factory()->create(['title' => 'Listing Only Service', 'show_on_homepage' => false, 'is_active' => true]);
    GalleryImage::factory()->count(8)->create();
    Testimonial::factory()->count(3)->create();
    BlogPost::factory()->count(2)->create();

    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('Homepage Teaser Service');
    $response->assertDontSee('Listing Only Service');
});

test('about page loads successfully', function () {
    $this->get(route('about'))->assertOk();
});

test('services page shows all active services regardless of homepage flag', function () {
    Service::factory()->create(['title' => 'Homepage Teaser Service', 'show_on_homepage' => true, 'is_active' => true]);
    Service::factory()->create(['title' => 'Listing Only Service', 'show_on_homepage' => false, 'is_active' => true]);
    Service::factory()->create(['title' => 'Inactive Service', 'is_active' => false]);

    $response = $this->get(route('services'));

    $response->assertOk();
    $response->assertSee('Homepage Teaser Service');
    $response->assertSee('Listing Only Service');
    $response->assertDontSee('Inactive Service');
});

test('gallery page loads and shows active images and videos', function () {
    GalleryImage::factory()->create(['alt_text' => 'A visible gallery photo', 'is_active' => true]);
    GalleryImage::factory()->create(['alt_text' => 'A hidden gallery photo', 'is_active' => false]);
    Video::factory()->create(['title' => 'A visible gallery video', 'category' => 'gallery', 'is_active' => true]);

    $response = $this->get(route('gallery'));

    $response->assertOk();
    $response->assertSee('A visible gallery photo');
    $response->assertDontSee('A hidden gallery photo');
    $response->assertSee('A visible gallery video');
});

test('testimonials page shows testimonials, featured reviews and rating stats', function () {
    Testimonial::factory()->create(['name' => 'Regular Reviewer', 'is_featured' => false]);
    Testimonial::factory()->create(['name' => 'Featured Reviewer', 'is_featured' => true]);
    RatingStat::factory()->create(['label' => 'Years of Trusted Legacy']);

    $response = $this->get(route('testimonials'));

    $response->assertOk();
    $response->assertSee('Regular Reviewer');
    $response->assertSee('Featured Reviewer');
    $response->assertSee('Years of Trusted Legacy');
});

test('contact page loads successfully', function () {
    $this->get(route('contact'))->assertOk();
});

test('blogs listing page loads and shows active posts', function () {
    BlogPost::factory()->create(['title' => 'A visible blog post', 'is_active' => true]);
    BlogPost::factory()->create(['title' => 'A hidden blog post', 'is_active' => false]);

    $response = $this->get(route('blogs'));

    $response->assertOk();
    $response->assertSee('A visible blog post');
    $response->assertDontSee('A hidden blog post');
});

test('blog detail page renders for a valid slug', function () {
    $post = BlogPost::factory()->create(['title' => 'A Specific Wedding Story', 'is_active' => true]);

    $response = $this->get(route('blog.show', $post->slug));

    $response->assertOk();
    $response->assertSee('A Specific Wedding Story');
});

test('blog detail page 404s for an unknown slug', function () {
    $this->get('/blog/this-slug-does-not-exist')->assertNotFound();
});

test('blog detail page 404s for an inactive post', function () {
    $post = BlogPost::factory()->create(['is_active' => false]);

    $this->get(route('blog.show', $post->slug))->assertNotFound();
});

test('success story page loads and shows stories and destinations', function () {
    SuccessStory::factory()->create(['title' => 'A Royal Union Story', 'is_active' => true]);
    Destination::factory()->create(['name' => 'Jaipur', 'is_active' => true]);

    $response = $this->get(route('success-story'));

    $response->assertOk();
    $response->assertSee('A Royal Union Story');
    $response->assertSee('Jaipur');
});
