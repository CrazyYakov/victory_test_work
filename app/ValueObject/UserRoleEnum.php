<?php

declare(strict_types=1);

namespace App\ValueObject;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}
