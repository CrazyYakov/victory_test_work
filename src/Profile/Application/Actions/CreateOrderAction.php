<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Application\Actions;

use OrderManagement\Profile\Domain\Aggregates\Order;
use OrderManagement\Profile\Domain\Entities\Product;
use OrderManagement\Profile\Infrastructure\Managers\OrderManager;

readonly class CreateOrderAction
{
    public function __construct(
        private OrderManager $orderManager
    ) {}

    public function execute(int $userId, Product ...$products): int
    {
        $order = new Order(
            $userId,
            $products
        );

        return $this->orderManager->createOrder($order);
    }
}
