<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\ValueObject\UserRoleEnum;

class OrderPolicy
{
    public function update(User $user): bool
    {
        return $user->role === UserRoleEnum::ADMIN;
    }

    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->user_id;
    }
}
