<?php

namespace Tests\Feature\Public;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductsTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.public.products.index';

    public function testAccessDeniedWithoutUser(): void
    {
        $route = route(static::ROUTE_NAME);

        $response = $this->getJson($route);

        $response->assertUnauthorized();
    }

    public function testIndex(): void
    {
        $user = User::factory()
            ->create();

        Product::factory()
            ->count(3)
            ->create();

        $route = route(static::ROUTE_NAME);

        $response = $this->actingAs($user)
            ->getJson($route);

        $response->assertOk()
            ->assertJsonIsArray('products')
            ->assertJsonCount(3, 'products');
    }
}
