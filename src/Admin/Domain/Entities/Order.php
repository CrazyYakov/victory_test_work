<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Domain\Entities;

use OrderManagement\Admin\Domain\Values\Enums\OrderStatusEnum;

readonly class Order
{
    public function __construct(
        public int $id,
        public OrderStatusEnum $status
    ) {}
}
