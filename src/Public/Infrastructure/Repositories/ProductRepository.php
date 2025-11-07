<?php

declare(strict_types=1);

namespace OrderManagement\Public\Infrastructure\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function all(): Collection
    {
        return Product::all();
    }
}
