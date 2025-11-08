<?php

namespace Tests\Feature\Profile;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowOrderOfCurrentUserTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.profile.orders.show';

    public function testNotFound(): void
    {
        $user = User::factory()
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => 1,
        ]);

        $response = $this->actingAs($user)
            ->getJson($route);

        $response->assertNotFound();
    }

    public function testUnauthorized(): void
    {
        $order = Order::factory()
            ->hasAttached(
                factory: Product::factory()
                    ->count(2),
                pivot: [
                    'quantity' => 2,
                    'price' => 10_000,
                ]
            )
            ->for(
                User::factory()
                    ->create()
            )
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => $order,
        ]);

        $response = $this->getJson($route);

        $response->assertUnauthorized();
    }

    public function testExist(): void
    {
        $user = User::factory()
            ->create();

        $order = Order::factory()
            ->hasAttached(
                factory: Product::factory()
                    ->count(2),
                pivot: [
                    'quantity' => 2,
                    'price' => 10000,
                ]
            )
            ->for($user)
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => $order->getKey(),
        ]);

        $response = $this->actingAs($user)
            ->getJson($route);

        $response->assertOk()
            ->assertJsonCount(2, 'order.products')
            ->assertJsonIsArray('order.products')
            ->assertJsonStructure([
                'order' => [
                    'products' => [
                        '*' => [
                            'id',
                            'quantity',
                        ],
                    ],
                ],
            ]);
    }

    public function testNoAccessToSomeoneElseOrder(): void
    {
        $anotherUser = User::factory()
            ->create();

        $anotherOrder = Order::factory()
            ->hasAttached(
                factory: Product::factory()
                    ->count(2),
                pivot: [
                    'quantity' => 2,
                    'price' => 10_000,
                ]
            )
            ->for($anotherUser)
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => $anotherOrder->getKey(),
        ]);

        $currentUser = User::factory()
            ->create();

        $response = $this->actingAs($currentUser)
            ->getJson($route);

        $response->assertNotFound();
    }
}
