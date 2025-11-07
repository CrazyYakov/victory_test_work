<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Application\Actions;

use OrderManagement\Admin\Domain\Entities\Product;
use OrderManagement\Admin\Infrastructure\Manager\ProductManager;

readonly class UpdateProductAction
{
    public function __construct(
        private ProductManager $productManager
    ) {}

    public function execute(int $productId, Product $product): void
    {
        $this->productManager
            ->update($productId, $product);
    }
}
