<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Application\Actions;

use OrderManagement\Admin\Domain\Entities\Product;
use OrderManagement\Admin\Infrastructure\Manager\ProductManager;

readonly class CreateProductAction
{
    public function __construct(
        private ProductManager $productManager
    ) {}

    public function execute(Product $product): void
    {
        $this->productManager
            ->create($product);
    }
}
