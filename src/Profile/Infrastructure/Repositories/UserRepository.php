<?php

declare(strict_types=1);

namespace OrderManagement\Profile\Infrastructure\Repositories;

use App\Models\User;

class UserRepository
{
    public function getModelById(int $userId): User
    {
        return User::query()->findOrFail($userId);
    }
}
