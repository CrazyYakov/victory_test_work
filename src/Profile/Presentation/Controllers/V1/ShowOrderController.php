<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Presentation\Controllers\V1;

use App\Models\Order;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use OrderManagement\Common\Presentation\Responses\NotFoundResponse;
use OrderManagement\Profile\Presentation\Resoruces\V1\OrderResource;

class ShowOrderController
{
    public function __invoke(Order $order): Responsable
    {
        if (Gate::denies('view', $order)) {
            return new NotFoundResponse('order not found');
        }

        OrderResource::wrap('order');

        return new OrderResource($order);
    }
}
