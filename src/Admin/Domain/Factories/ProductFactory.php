<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Domain\Factories;

use OrderManagement\Admin\Domain\Entities\Product;

class ProductFactory
{
    public function create(array $data): Product
    {
        return new Product(
            name: $data['name'],
            price: $data['price'],
        );
    }
}
