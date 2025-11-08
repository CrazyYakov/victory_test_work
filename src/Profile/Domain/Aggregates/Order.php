<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Domain\Aggregates;

readonly class Order
{
    public function __construct(
        public int $userId,
        public array $products,
    ) {}
}
