<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Infrastructure\Manager;

use App\Models\Order;
use OrderManagement\Admin\Domain\Values\Enums\OrderStatusEnum;

class OrderManager
{

    public function changeStatus(int $orderId, OrderStatusEnum $status): void
    {
        $model = Order::findOrFail($orderId);
        $model->status = $status->value;
        $model->save();
    }
}
