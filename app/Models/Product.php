<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read null|string $name
 * @property-read null|float $price
 */
class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;
}
