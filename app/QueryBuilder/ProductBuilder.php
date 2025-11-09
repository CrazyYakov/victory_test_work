<?php

declare(strict_types=1);

namespace App\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function whereInId(array $ids): static
    {
        return $this->whereIn('id', $ids);
    }
}
