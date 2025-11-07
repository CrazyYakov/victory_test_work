<?php

namespace App\Models;

use App\ValueObject\OrderStatusEnum;
use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property OrderStatusEnum $status
 *
 * @property-read int $id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read Collection|Product[] $products
 */
class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'status' => OrderStatusEnum::class,
        ];
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps()
            ->withPivot('quantity');
    }
}
