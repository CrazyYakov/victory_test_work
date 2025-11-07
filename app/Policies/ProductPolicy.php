<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use App\ValueObject\UserRoleEnum;

class ProductPolicy
{
    public function create(User $user): bool
    {
        return $user->role === UserRoleEnum::ADMIN;
    }

    public function update(User $user): bool
    {
        return $user->role === UserRoleEnum::ADMIN;
    }
}
