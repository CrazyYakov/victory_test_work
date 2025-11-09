<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Infrastructure\Managers;

use Illuminate\Support\Arr;
use OrderManagement\Profile\Domain\Aggregates\Order;
use OrderManagement\Profile\Domain\Entities\Product;
use OrderManagement\Profile\Domain\Values\List\ProductList;

class OrderManager
{
    public function createOrder(Order $order): int
    {
        $orderModel = new \App\Models\Order();
        $orderModel->user_id = $order->userId;
        $orderModel->status = 'new';
        $orderModel->save();

        $orderModel->products()->attach(
            $this->transformProductsForAttachInOrder($order->productList)
        );

        return $orderModel->getKey();
    }

    protected function transformProductsForAttachInOrder(ProductList $products): array
    {
        $priceList = \App\Models\Product::query()
            ->whereInId($products->getIds())
            ->pluck('price', 'id');

        return collect($products->get())
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
