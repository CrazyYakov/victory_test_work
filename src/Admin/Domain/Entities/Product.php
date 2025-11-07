<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Domain\Entities;

readonly class Product
{
    public function __construct(
        public string $name,
        public float $price,
    ) {}
}
