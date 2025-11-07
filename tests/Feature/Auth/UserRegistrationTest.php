<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected const ROUTE_NAME = 'v1.auth.registration';

    public function testRegistration(): void
    {
        $email = $this->faker->email;

        $route = route(static::ROUTE_NAME);

        $response = $this->postJson($route, [
            'email' => $email,
            'password' => 'password',
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }

    public function testUserExist(): void
    {
        $user = User::factory()
            ->create();

        $route = route(self::ROUTE_NAME);

        $response = $this->postJson($route, [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertUnprocessable();
    }

    public function testEmptyRequest(): void
    {
        $route = route(self::ROUTE_NAME);

        $response = $this->postJson($route);

        $response->assertUnprocessable();
    }
}
