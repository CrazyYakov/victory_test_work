<?php

declare(strict_types=1);

namespace App\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;

class OrderBuilder extends Builder
{
    public function whereUserId(int $userId): static
    {
        return $this->where('user_id', $userId);
    }

    public function withProducts(): static
    {
        return $this->with('products');
    }
}
