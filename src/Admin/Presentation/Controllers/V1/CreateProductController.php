<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Controllers\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use OrderManagement\Admin\Application\Actions\CreateProductAction;
use OrderManagement\Admin\Domain\Entities\Product;
use OrderManagement\Admin\Presentation\Requests\V1\CreateProductRequest;
use OrderManagement\Common\Presentation\Responses\AccessDeniedResponse;
use OrderManagement\Common\Presentation\Responses\CreatedResponse;

readonly class CreateProductController
{
    public function __construct(
        private CreateProductAction $createProductAction
    ) {}

    public function __invoke(CreateProductRequest $request): Responsable
    {
        if (Gate::denies('create', \App\Models\Product::class)) {
            return new AccessDeniedResponse(
                'You are not allowed to create a product'
            );
        }

        $product = new Product(
            name: $request->name,
            price: $request->price,
        );

        $this->createProductAction->execute($product);

        return new CreatedResponse();
    }
}
