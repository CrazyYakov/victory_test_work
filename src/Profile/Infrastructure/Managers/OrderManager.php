<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Infrastructure\Managers;

use OrderManagement\Profile\Domain\Aggregates\Order;
use OrderManagement\Profile\Domain\Entities\Product;

class OrderManager
{

    public function createOrder(Order $order): int
    {
        $model = new \App\Models\Order();
        $model->user_id = $order->userId;
        $model->status = 'new';
        $model->save();

        $products = collect($order->products)
            ->keyBy(fn(Product $product) => $product->id)
            ->map(fn(Product $product) => ['quantity' => $product->quantity, 'price' => $product->price]);

        $model->products()->attach($products);

        return $model->getKey();
    }
}
