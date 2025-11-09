<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Application\Actions;

use OrderManagement\Admin\Domain\Entities\Order;
use OrderManagement\Admin\Domain\Values\Enums\OrderStatusEnum;
use OrderManagement\Admin\Infrastructure\Manager\OrderManager;

readonly class ChangeOrderStatusAction
{
    public function __construct(
        private OrderManager $orderManager
    ) {}

    public function execute(int $orderId, OrderStatusEnum $status): void
    {
        $order = new Order($orderId, $status);

        $this->orderManager->changeStatus($order);
    }
}
