<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Domain\Factories;

use OrderManagement\Profile\Domain\Entities\Product;

class ProductFactory
{
    public function create(array $data): Product
    {
        return new Product(
            id: $data['id'],
            quantity: $data['quantity'],
        );
    }
}
