<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Infrastructure\Manager;

use App\ValueObject\UserRoleEnum;
use OrderManagement\Auth\Domain\Entities\User;

class UserManager
{
    private const TOKEN_NAME = 'user';

    public function createUser(string $email, string $password): User
    {
        $model = new \App\Models\User();
        $model->email = $email;
        $model->password = $password;
        $model->role = UserRoleEnum::USER;
        $model->save();

        return new User(
            email: $model->email,
            password: $model->password,
        );
    }

    public function createToken(User $user): string
    {
        $model = \App\Models\User::query()
            ->whereEmail($user->email)
            ->firstOrFail();

        return $model->createToken(self::TOKEN_NAME)
            ->plainTextToken;
    }
}
