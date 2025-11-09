<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Requests\V1;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('create', Product::class);
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
