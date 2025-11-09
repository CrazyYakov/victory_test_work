<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Infrastructure\Managers;

use Illuminate\Support\Arr;
use OrderManagement\Profile\Domain\Aggregates\Order;
use OrderManagement\Profile\Domain\Entities\Product;

class OrderManager
{
    public function createOrder(Order $order): int
    {
        $orderModel = new \App\Models\Order();
        $orderModel->user_id = $order->userId;
        $orderModel->status = 'new';
        $orderModel->save();

        $orderModel->products()->attach(
            $this->transformProductsForAttachInOrder($order->products)
        );

        return $orderModel->getKey();
    }

    protected function transformProductsForAttachInOrder(array $products): array
    {
        $productIds = Arr::pluck($products, 'id');

        $priceList = \App\Models\Product::query()
            ->whereInId($productIds)
            ->pluck('price', 'id');

        return collect($products)
            ->keyBy('id')
            ->map(
                fn(Product $product, int $id) => [
                    'quantity' => $product->quantity,
                    'price' => $priceList->get($id)
                ]
            )
            ->all();
    }
}
