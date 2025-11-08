<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    public function byUserId(int $userId): Collection
    {
        return \App\Models\Order::query()
            ->withProducts()
            ->whereUserId($userId)
            ->get();
    }
}
