<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\ValueObject\UserRoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.admin.products.store';

    public function testAccessDeniedForUser(): void
    {
        $route = route(static::ROUTE_NAME);

        $requestData = [
            'name' => 'product',
            'price' => 10000,
        ];

        $user = User::factory()
            ->set('role', UserRoleEnum::USER->value)
            ->create();

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertForbidden();

        $this->assertDatabaseCount('products', 0);
    }

    public function testAccessDeniedWithoutUser(): void
    {
        $route = route(static::ROUTE_NAME);

        $requestData = [
            'name' => 'product',
            'price' => 10000,
        ];

        $response = $this->postJson($route, $requestData);

        $response->assertForbidden();

        $this->assertDatabaseCount('products', 0);
    }

    public function testCreate(): void
    {
        $route = route(static::ROUTE_NAME);

        $user = User::factory()
            ->set('role', UserRoleEnum::ADMIN->value)
            ->create();

        $requestData = [
            'name' => 'product',
            'price' => 10_000,
        ];

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertCreated();

        $this->assertDatabaseHas('products', [
            'name' => 'Product',
            'price' => 10_000,
        ]);
    }
}
