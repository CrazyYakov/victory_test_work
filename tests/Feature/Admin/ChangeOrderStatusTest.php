<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use App\Models\User;
use App\ValueObject\UserRoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeOrderStatusTest extends TestCase
{
    use RefreshDatabase;

    protected const ROUTE_NAME = 'v1.admin.orders.change-status';

    public function testOrderNotFound(): void
    {
        $user = User::factory()
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => 1000,
        ]);

        $response = $this->actingAs($user)
            ->postJson($route, [
                'status' => 'processing'
            ]);

        $response->assertNotFound();
    }

    public function testUnauthorized(): void
    {
        $order = Order::factory()
            ->for(
                User::factory()
                    ->create()
            )
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => $order,
        ]);

        $response = $this->postJson($route, [
            'status' => 'processing',
        ]);

        $response->assertUnauthorized();
    }

    public function testAccessDenied(): void
    {
        $user = User::factory()
            ->set('role', UserRoleEnum::USER->value)
            ->create();

        $order = Order::factory()
            ->for($user)
            ->set('status', 'new')
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => $order,
        ]);

        $response = $this->actingAs($user)
            ->postJson($route, [
                'status' => 'processing',
            ]);

        $response->assertForbidden();
    }

    public function testChangeStatus(): void
    {
        $user = User::factory()
            ->set('role', UserRoleEnum::ADMIN->value)
            ->create();

        $order = Order::factory()
            ->for($user)
            ->set('status', 'new')
            ->create();

        $route = route(static::ROUTE_NAME, [
            'order' => $order,
        ]);

        $response = $this->actingAs($user)
            ->postJson($route, [
                'status' => 'processing',
            ]);

        $response->assertOk();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'processing',
        ]);
    }
}
