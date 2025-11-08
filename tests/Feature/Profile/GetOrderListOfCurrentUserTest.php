<?php

namespace Tests\Feature\Profile;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetOrderListOfCurrentUserTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.profile.orders.index';

    public function testEmptyList(): void
    {
        $user = User::factory()
            ->create();

        $route = route(static::ROUTE_NAME);

        $response = $this->actingAs($user)
            ->getJson($route);

        $response->assertOk()
            ->assertJsonCount(0, 'orders');
    }

    public function testGetListOfCurrentUserOrders(): void
    {
        $user = User::factory()
            ->create();

        Order::factory()
            ->count(3)
            ->hasAttached(
                factory: Product::factory()
                    ->count(2),
                pivot: [
                    'quantity' => 2,
                    'price' => 10_000,
                ]
            )
            ->for($user)
            ->create();

        $route = route(static::ROUTE_NAME);

        $response = $this->actingAs($user)
            ->getJson($route);

        $response->assertOk()
            ->assertJsonIsArray('orders')
            ->assertJsonCount(3, 'orders');
    }
}
