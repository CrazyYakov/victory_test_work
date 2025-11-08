<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Application\Actions;

use OrderManagement\Profile\Domain\Aggregates\Order;
use OrderManagement\Profile\Domain\Entities\Product;
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
        $order = new Order($userId, $products);

        $orderId = $this->orderManager->createOrder($order);

        $this->orderNotification->orderSuccessfullyPlaced($orderId, $userId);

        return $orderId;
    }
}
