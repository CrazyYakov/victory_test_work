<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\User;
use App\ValueObject\UserRoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.admin.products.update';

    public function testAccessDeniedForUser(): void
    {
        $product = Product::factory()
            ->set('name', 'Product')
            ->set('price', 10_000)
            ->create();

        $requestData = [
            'name' => 'update product',
            'price' => 20_000,
        ];

        $user = User::factory()
            ->set('role', UserRoleEnum::USER->value)
            ->create();

        $route = route(static::ROUTE_NAME, [
            'product' => $product,
        ]);

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertForbidden();
    }

    public function testAccessDeniedWithoutUser(): void
    {
        $requestData = [
            'name' => 'product',
            'price' => 10000,
        ];

        $product = Product::factory()
            ->set('name', 'Product')
            ->set('price', 10_000)
            ->create();

        $route = route(static::ROUTE_NAME, [
            'product' => $product,
        ]);

        $response = $this->postJson($route, $requestData);

        $response->assertForbidden();
    }


    public function testNotFound(): void
    {
        $requestData = [
            'name' => 'product',
            'price' => 10000,
        ];

        $user = User::factory()
            ->set('role', UserRoleEnum::ADMIN->value)
            ->create();

        $route = route(static::ROUTE_NAME, [
            'product' => 1000,
        ]);

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertNotFound();
    }

    public function testUpdate(): void
    {
        $requestData = [
            'name' => 'update product',
            'price' => 20_000,
        ];

        $user = User::factory()
            ->set('role', UserRoleEnum::ADMIN->value)
            ->create();

        $product = Product::factory()
            ->set('name', 'Product')
            ->set('price', 10_000)
            ->create();

        $route = route(static::ROUTE_NAME, [
            'product' => $product,
        ]);

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertOk();

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'update product',
            'price' => 20_000,
        ]);
    }
}
