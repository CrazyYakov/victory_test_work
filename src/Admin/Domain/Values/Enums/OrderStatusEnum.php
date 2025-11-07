<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Domain\Values\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function values(): array
    {
        return collect(self::cases())
            ->map(fn(self $case) => $case->value)
            ->all();
    }
}
