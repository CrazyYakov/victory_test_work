<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Requests\V1;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use OrderManagement\Admin\Domain\Values\Enums\OrderStatusEnum;


/**
 * @property-read Order $order
 */
class ChangeOrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', $this->order);
    }

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
