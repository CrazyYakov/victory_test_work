<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Infrastructure\Manager;

use App\Models\Order as OrderModel;
use OrderManagement\Admin\Domain\Entities\Order;

class OrderManager
{
    public function changeStatus(Order $order): void
    {
        $model = OrderModel::findOrFail($order->id);
        $model->status = $order->status->value;
        $model->save();
    }
}
