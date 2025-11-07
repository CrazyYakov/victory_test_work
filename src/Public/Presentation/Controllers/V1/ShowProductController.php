<?php

declare(strict_types=1);

namespace OrderManagement\Public\Presentation\Controllers\V1;

use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use OrderManagement\Public\Presentation\Resources\V1\ProductResource;

readonly class ShowProductController
{
    public function __invoke(Product $product): Responsable
    {
        ProductResource::wrap('product');

        return new ProductResource($product);
    }
}
