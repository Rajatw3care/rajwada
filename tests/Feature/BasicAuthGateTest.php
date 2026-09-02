<?php

test('when disabled, the site is reachable with no credentials', function () {
    config(['app.basic_auth_enabled' => false]);

    $this->get('/')->assertOk();
});

test('when enabled, a request with no credentials gets a 401 challenge', function () {
    config([
        'app.basic_auth_enabled' => true,
        'app.basic_auth_username' => 'rajwada',
        'app.basic_auth_password' => 'secret-pass',
    ]);

    $response = $this->get('/');

    $response->assertStatus(401);
    $response->assertHeader('WWW-Authenticate', 'Basic realm="Rajwada Events"');
});

test('when enabled, wrong credentials are rejected', function () {
    config([
        'app.basic_auth_enabled' => true,
        'app.basic_auth_username' => 'rajwada',
        'app.basic_auth_password' => 'secret-pass',
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Basic '.base64_encode('rajwada:wrong-password'),
    ])->get('/');

    $response->assertStatus(401);
});

test('when enabled, correct credentials pass through', function () {
    config([
        'app.basic_auth_enabled' => true,
        'app.basic_auth_username' => 'rajwada',
        'app.basic_auth_password' => 'secret-pass',
    ]);

    $response = $this->withHeaders([
        'Authorization' => 'Basic '.base64_encode('rajwada:secret-pass'),
    ])->get('/');

    $response->assertOk();
});

test('when enabled, the health check endpoint stays open with no credentials', function () {
    config(['app.basic_auth_enabled' => true]);

    $this->get('/up')->assertOk();
});
