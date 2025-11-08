<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Presentation\Resoruces\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'price' => $this->resource->pivot->price,
            'quantity' => $this->resource->pivot->quantity,
        ];
    }
}
