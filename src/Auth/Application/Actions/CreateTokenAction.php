<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Application\Actions;

use OrderManagement\Auth\Domain\Entities\User;
use OrderManagement\Auth\Infrastructure\Manager\UserManager;

readonly class CreateTokenAction
{
    public function __construct(
        private UserManager $userManager
    ) {}

    public function __invoke(User $user): string
    {
        return $this->userManager->createToken($user);
    }
}
