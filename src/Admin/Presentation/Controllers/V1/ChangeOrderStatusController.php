<?php

declare(strict_types=1);

namespace OrderManagement\Admin\Presentation\Controllers\V1;

use App\Models\Order;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Gate;
use OrderManagement\Admin\Application\Actions\ChangeOrderStatusAction;
use OrderManagement\Admin\Domain\Values\Enums\OrderStatusEnum;
use OrderManagement\Admin\Presentation\Requests\V1\ChangeOrderStatusRequest;
use OrderManagement\Common\Presentation\Responses\SuccessResponse;
use OrderManagement\Common\Presentation\Responses\AccessDeniedResponse;

readonly class ChangeOrderStatusController
{
    public function __construct(
        private ChangeOrderStatusAction $changeOrderStatusAction
    ) {}

    public function __invoke(Order $order, ChangeOrderStatusRequest $request): Responsable
    {
        if (Gate::denies('update', $order)) {
            return new AccessDeniedResponse('You are not allowed to update this order');
        }

        $this->changeOrderStatusAction
            ->execute(
                $order->id,
                $request->enum('status', OrderStatusEnum::class)
            );

        return new SuccessResponse();
    }
}
