<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Controllers\V1;

use Illuminate\Contracts\Support\Responsable;
use OrderManagement\Admin\Application\Actions\CreateProductAction;
use OrderManagement\Admin\Domain\Factories\ProductFactory;
use OrderManagement\Admin\Presentation\Requests\V1\CreateProductRequest;
use OrderManagement\Common\Presentation\Responses\CreatedResponse;

readonly class CreateProductController
{
    public function __construct(
        private CreateProductAction $createProductAction,
        private ProductFactory $productFactory
    ) {}

    public function __invoke(CreateProductRequest $request): Responsable
    {
        $this->createProductAction->execute(
            $this->productFactory
                ->create($request->validated())
        );

        return new CreatedResponse();
    }
}
