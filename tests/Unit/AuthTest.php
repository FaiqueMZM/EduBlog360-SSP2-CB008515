<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        $response = $this->post('/register', [
            'name' => 'Miles Morales',
            'email' => 'miles@gmail.com',
            'user' => 'Reader',
            'password' => 'iammiles8',
            'password_confirmation' => 'iammiles8',
        ]);

        $response->assertRedirect('/');
    }

    public function test_login_user()
    {
        $response = $this->post('/register', [
            'email' => 'miles@gmail.com',
            'password' => 'iammiles8',
        ]);

        $response->assertRedirect('/');
    }

    public function test_check_for_user_in_db()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'Miles Morales',
        ]);
    }
}
