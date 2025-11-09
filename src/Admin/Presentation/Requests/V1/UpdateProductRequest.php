<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Requests\V1;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * @property-read Product $product
 */
class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', $this->product);
    }

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
