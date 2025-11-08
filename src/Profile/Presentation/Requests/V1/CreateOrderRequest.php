<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Presentation\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read array $products
 */
class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'int', 'exists:products,id'],
            'products.*.price' => ['required', 'numeric:strict', 'decimal:0,2'],
            'products.*.quantity' => ['required', 'integer'],
        ];
    }
}
