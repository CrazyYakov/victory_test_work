<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Presentation\Resoruces\V1;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Order $resource
 */
class OrderResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'status' => $this->resource->status,
            'products' => ProductResource::collection($this->resource->products),
        ];
    }
}
