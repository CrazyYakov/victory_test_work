<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Domain\Values\List;

use OrderManagement\Profile\Domain\Entities\Product;

readonly class ProductList
{
    private array $products;

    public function __construct(Product ...$products)
    {
        $this->products = $products;
    }

    public function get(): array
    {
        return $this->products;
    }

    public function getIds(): array
    {
        return array_map(fn(Product $product) => $product->id, $this->products);
    }
}
