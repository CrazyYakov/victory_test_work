<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Domain\Aggregates;

use OrderManagement\Profile\Domain\Values\List\ProductList;

readonly class Order
{
    public function __construct(
        public int $userId,
        public ProductList $productList,
    ) {}
}
