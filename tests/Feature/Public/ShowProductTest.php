<?php

namespace Tests\Feature\Public;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.public.products.show';

    public function testUnauthorized(): void
    {
        $route = route(static::ROUTE_NAME, [
            'product' => 1000,
        ]);

        $response = $this->getJson($route);

        $response->assertUnauthorized();
    }

    public function testShow(): void
    {
        $user = User::factory()
            ->create();

        $product = Product::factory()
            ->create();

        $route = route(static::ROUTE_NAME, [
            'product' => $product,
        ]);

        $response = $this->actingAs($user)
            ->getJson($route);

        $response->assertOk()
            ->assertJsonStructure([
                'product' => [
                    'id',
                    'name',
                    'price',
                ]
            ]);
    }
}
