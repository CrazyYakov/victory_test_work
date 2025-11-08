<?php

namespace Tests\Feature\Profile;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use OrderManagement\Profile\Infrastructure\Notifications\OrderSuccessfullyPlaced;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.profile.orders.store';

    public function testUnauthorized(): void
    {
        $product = Product::factory()
            ->create();

        $route = route(static::ROUTE_NAME);

        $requestData = [
            'products' => [
                [
                    'productId' => $product->id,
                    'quantity' => 2
                ],
            ],
        ];

        $response = $this->postJson($route, $requestData);

        $response->assertUnauthorized();

        $this->assertDatabaseCount('order_product', 0);
    }

    public function testEmptyData(): void
    {
        $user = User::factory()
            ->create();

        $route = route(static::ROUTE_NAME);

        $response = $this->actingAs($user)
            ->postJson($route);

        $response->assertUnprocessable();

        $this->assertDatabaseCount('order_product', 0);
    }

    public function testCreateOrder(): void
    {
        $product = Product::factory()
            ->create();

        $user = User::factory()
            ->create();

        $route = route(static::ROUTE_NAME);

        $requestData = [
            'products' => [
                [
                    'id' => $product->id,
                    'price' => 1000.25,
                    'quantity' => 2
                ],
            ],
        ];

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertCreated();

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount('order_product', 1);
    }

    public function testAttachMoreProducts(): void
    {
        $countProducts = 2;

        $products = Product::factory()
            ->count($countProducts)
            ->create();

        $route = route(static::ROUTE_NAME);

        $requestData = [
            'products' => $products->map(function (Product $product) {
                return [
                    'id' => $product->id,
                    'price' => 1000.00,
                    'quantity' => random_int(1, 5),
                ];
            })->all()
        ];

        $user = User::factory()
            ->create();

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertCreated();

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount('order_product', $countProducts);

        $this->assertDatabaseHas('order_product', [
            'product_id' => $products->random()
                ->getKey(),

            'order_id' => $user->load('orders')
                ->orders
                ->first()
                ->getKey(),
        ]);
    }

    public function testNotification()
    {
        Notification::fake();

        $product = Product::factory()
            ->create();

        $user = User::factory()
            ->create();

        $route = route(static::ROUTE_NAME);

        $requestData = [
            'products' => [
                [
                    'id' => $product->id,
                    'price' => 1000.25,
                    'quantity' => 2
                ],
            ],
        ];

        $response = $this->actingAs($user)
            ->postJson($route, $requestData);

        $response->assertCreated();

        Notification::assertSentTo($user, OrderSuccessfullyPlaced::class);
    }
}
