<?php

use App\Models\User;

it('can render the login screen', function () {
    $this->get('/login')
        ->assertStatus(200);
});

it('allows users to authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));
});

it('does not allow users to authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

// it('allows users to logout', function () {
//     $user = User::factory()->create();

//     $response = $this->actingAs($user)
//         ->post('/logout');

//     $this->assertGuest();

//     $response->assertRedirect('/login');
// });
