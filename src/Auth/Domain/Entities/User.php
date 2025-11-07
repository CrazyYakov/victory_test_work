<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Domain\Entities;

use Illuminate\Support\Facades\Hash;

readonly class User
{
    public function __construct(
        public string $email,
        public string $password
    ) {}

    public function checkPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}
