<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Domain\Entities;

readonly class Product
{
    public function __construct(
        public int $id,
        public int $quantity,
    ) {}
}
