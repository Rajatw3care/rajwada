<?php

test('every response carries the noindex, nofollow X-Robots-Tag header', function (string $path) {
    $response = $this->get($path);

    $response->assertHeader('X-Robots-Tag');
    expect($response->headers->get('X-Robots-Tag'))->toContain('noindex')->toContain('nofollow');
})->with([
    'home' => '/',
    'about' => '/about',
    'login' => '/login',
]);

test('the homepage has a noindex, nofollow meta robots tag', function () {
    $this->get('/')->assertSee('<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">', false);
});

test('the admin login page has a noindex, nofollow meta robots tag', function () {
    $this->get('/login')->assertSee('<meta name="robots" content="noindex, nofollow, noarchive, nosnippet">', false);
});

test('robots.txt disallows all crawling', function () {
    // public/robots.txt is a static file served directly by the real webserver
    // (Apache/Nginx never route it through Laravel), so it's checked on disk
    // rather than through the HTTP test client, which only knows app routes.
    $contents = file_get_contents(public_path('robots.txt'));

    expect($contents)->toContain('Disallow: /');
});
