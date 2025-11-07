<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Infrastructure\Repositories;

use OrderManagement\Auth\Domain\Entities\User;

class UserRepository
{
    public function byEmail(string $email): ?User
    {
        $user = \App\Models\User::query()
            ->whereEmail($email)
            ->first();

        return transform($user, function (\App\Models\User $user) {
            return new User(
                email: $user->email,
                password: $user->password,
            );
        });
    }
}
