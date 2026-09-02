<?php

use App\Models\ContactMessage;

test('a valid contact submission is stored and redirects back with success', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Meera Sharma',
        'phone' => '9876543210',
        'email' => 'meera@example.com',
        'message' => 'We would like to enquire about a royal wedding package.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');
    $response->assertSessionHasNoErrors();

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Meera Sharma',
        'phone' => '9876543210',
        'email' => 'meera@example.com',
    ]);
});

test('name, phone, email and message are all required', function () {
    $response = $this->post(route('contact.submit'), []);

    $response->assertSessionHasErrors(['name', 'phone', 'email', 'message']);
    $this->assertDatabaseCount('contact_messages', 0);
});

test('phone must be digits only between 7 and 15 characters', function (string $phone) {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'phone' => $phone,
        'email' => 'test@example.com',
        'message' => 'A valid enquiry message here.',
    ]);

    $response->assertSessionHasErrors('phone');
})->with([
    'contains letters' => 'abc98765',
    'contains symbols' => '98765-4321',
    'too short (6 digits)' => '123456',
    'too long (16 digits)' => '1234567890123456',
]);

test('a valid 7 to 15 digit phone number passes validation', function (string $phone) {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'phone' => $phone,
        'email' => 'test@example.com',
        'message' => 'A valid enquiry message here.',
    ]);

    $response->assertSessionDoesntHaveErrors('phone');
})->with([
    'minimum length (7 digits)' => '1234567',
    'typical mobile (10 digits)' => '9876543210',
    'maximum length (15 digits)' => '123456789012345',
]);

test('email must be a valid email address', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'phone' => '9876543210',
        'email' => 'not-an-email',
        'message' => 'A valid enquiry message here.',
    ]);

    $response->assertSessionHasErrors('email');
});

test('message must be at least 5 characters', function () {
    $response = $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'phone' => '9876543210',
        'email' => 'test@example.com',
        'message' => 'Hi',
    ]);

    $response->assertSessionHasErrors('message');
});
