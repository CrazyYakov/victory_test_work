<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Application\Actions;

use OrderManagement\Auth\Infrastructure\Manager\UserManager;

readonly class CreateUserActions
{
    public function __construct(
        private UserManager $userManager
    ) {}

    public function __invoke(string $email, string $password): void
    {
        $this->userManager
            ->createUser($email, $password);
    }
}
