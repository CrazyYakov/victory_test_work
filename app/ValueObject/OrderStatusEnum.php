<?php

declare(strict_types=1);

namespace App\ValueObject;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
}
