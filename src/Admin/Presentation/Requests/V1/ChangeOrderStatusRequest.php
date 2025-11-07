<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use OrderManagement\Admin\Domain\Values\Enums\OrderStatusEnum;


class ChangeOrderStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => [
                'string',
                'required',
                Rule::in(OrderStatusEnum::values()),
            ],
        ];
    }
}
