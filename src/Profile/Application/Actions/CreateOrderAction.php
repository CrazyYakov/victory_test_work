<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Application\Actions;

use OrderManagement\Profile\Domain\Aggregates\Order;
use OrderManagement\Profile\Domain\Entities\Product;
use OrderManagement\Profile\Domain\Values\List\ProductList;
use OrderManagement\Profile\Infrastructure\Managers\OrderManager;
use OrderManagement\Profile\Infrastructure\Services\OrderNotification;

readonly class CreateOrderAction
{
    public function __construct(
        private OrderManager $orderManager,
        private OrderNotification $orderNotification
    ) {}

    public function execute(int $userId, Product ...$products): int
    {
        $productList = new ProductList(...$products);

        $order = new Order($userId, $productList);

        $orderId = $this->orderManager->createOrder($order);

        $this->orderNotification->orderSuccessfullyPlaced($orderId, $userId);

        return $orderId;
    }
}
