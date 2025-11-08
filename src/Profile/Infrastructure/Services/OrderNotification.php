<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Infrastructure\Services;

use Illuminate\Support\Facades\Notification;
use OrderManagement\Profile\Infrastructure\Notifications\OrderSuccessfullyPlaced;
use OrderManagement\Profile\Infrastructure\Repositories\UserRepository;

readonly class OrderNotification
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function orderSuccessfullyPlaced(int $orderId, int $userId): void
    {
        $user = $this->userRepository->getModelById($userId);

        Notification::send($user, new OrderSuccessfullyPlaced($orderId, $userId));
    }
}
