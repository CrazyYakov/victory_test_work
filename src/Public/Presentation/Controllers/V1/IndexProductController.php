<?php

declare(strict_types=1);

namespace OrderManagement\Public\Presentation\Controllers\V1;

use Illuminate\Contracts\Support\Responsable;
use OrderManagement\Public\Infrastructure\Repositories\ProductRepository;
use OrderManagement\Public\Presentation\Resources\V1\ProductResource;

readonly class IndexProductController
{
    public function __construct(
        private ProductRepository $productRepository
    ) {}

    public function __invoke(): Responsable
    {
        ProductResource::wrap('products');

        return ProductResource::collection(
            $this->productRepository->all()
        );
    }
}
