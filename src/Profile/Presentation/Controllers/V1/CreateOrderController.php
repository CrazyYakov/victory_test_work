<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Presentation\Controllers\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Arr;
use OrderManagement\Common\Presentation\Responses\CreatedResponse;
use OrderManagement\Profile\Application\Actions\CreateOrderAction;
use OrderManagement\Profile\Domain\Factories\ProductFactory;
use OrderManagement\Profile\Presentation\Requests\V1\CreateOrderRequest;

readonly class CreateOrderController
{
    public function __construct(
        private CreateOrderAction $createOrderAction,
        private ProductFactory $productFactory
    ) {}

    public function __invoke(CreateOrderRequest $request): Responsable
    {
        $products = Arr::map($request->products, [$this->productFactory, 'create']);

        $orderId = $this->createOrderAction
            ->execute($request->user()->getKey(), ...$products);

        return new CreatedResponse([
            'order' => [
                'id' => $orderId,
            ],
        ]);
    }
}
