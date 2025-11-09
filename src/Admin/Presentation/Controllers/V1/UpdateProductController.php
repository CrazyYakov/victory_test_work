<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Controllers\V1;

use App\Models\Product as ProductModel;
use Illuminate\Contracts\Support\Responsable;
use OrderManagement\Admin\Application\Actions\UpdateProductAction;
use OrderManagement\Admin\Domain\Factories\ProductFactory;
use OrderManagement\Admin\Presentation\Requests\V1\UpdateProductRequest;
use OrderManagement\Common\Presentation\Responses\SuccessResponse;

readonly class UpdateProductController
{
    public function __construct(
        private UpdateProductAction $updateProductAction,
        private ProductFactory $productFactory
    ) {}

    public function __invoke(ProductModel $product, UpdateProductRequest $request): Responsable
    {
        $this->updateProductAction->execute(
            $product->id,
            $this->productFactory
                ->create($request->validated())
        );

        return new SuccessResponse();
    }
}
