<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserAuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected const ROUTE_NAME = 'v1.auth.authorization';

    protected const PASSWORD = 'password';

    protected const WRONG_PASSWORD = 'wrong password';

    public function testAuthorization(): void
    {
        $user = User::factory()
            ->set('password', self::PASSWORD)
            ->create();

        $route = route(static::ROUTE_NAME);

        $response = $this->postJson($route, [
            'email' => $user->email,
            'password' => self::PASSWORD,
        ]);

        $response->assertOk()
            ->assertJson(function (AssertableJson $json) {
                $json->has('data.token')
                    ->etc();
            });
    }

    public function testUserNotFound(): void
    {
        $route = route(static::ROUTE_NAME);

        $response = $this->postJson($route, [
            'email' => $this->faker->email,
            'password' => self::PASSWORD,
        ]);

        $response->assertUnprocessable();
    }

    public function testWrongPassword(): void
    {
        $user = User::factory()
            ->set('password', self::PASSWORD)
            ->create();

        $route = route(static::ROUTE_NAME);

        $response = $this->postJson($route, [
            'email' => $user->email,
            'password' => self::WRONG_PASSWORD,
        ]);

        $response->assertUnprocessable();
    }
}
