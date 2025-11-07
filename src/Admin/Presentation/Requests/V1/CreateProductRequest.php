<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $name
 * @property-read float $price
 */
class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'price' => [
                'required',
                'decimal:0,2',
                'numeric:strict',
                'min:0',
            ],
        ];
    }
}
