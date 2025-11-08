<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Presentation\Controllers\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use OrderManagement\Profile\Infrastructure\Repositories\OrderRepository;
use OrderManagement\Profile\Presentation\Resoruces\V1\OrderResource;

readonly class IndexOrderController
{
    public function __construct(
        private OrderRepository $orderRepository,
    ) {}

    public function __invoke(Request $request): Responsable
    {
        OrderResource::wrap('orders');

        return OrderResource::collection(
            $this->orderRepository->byUserId($request->user()->id)
        );
    }
}
