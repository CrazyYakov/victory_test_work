<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Controllers\V1;

use App\Models\Product as ProductModel;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use OrderManagement\Admin\Application\Actions\UpdateProductAction;
use OrderManagement\Admin\Domain\Entities\Product;
use OrderManagement\Admin\Presentation\Requests\V1\UpdateProductRequest;
use OrderManagement\Common\Presentation\Responses\AccessDeniedResponse;
use OrderManagement\Common\Presentation\Responses\SuccessResponse;

readonly class UpdateProductController
{
    public function __construct(
        private UpdateProductAction $updateProductAction
    ) {}

    public function __invoke(ProductModel $product, UpdateProductRequest $request): Responsable
    {
        if (Gate::denies('update', $product)) {
            return new AccessDeniedResponse(
                'You are not allowed to update this product'
            );
        }

        $entity = new Product(
            name: $request->name,
            price: $request->price,
        );

        $this->updateProductAction
            ->execute($product->id, $entity);

        return new SuccessResponse();
    }
}
