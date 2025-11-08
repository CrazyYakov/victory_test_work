<?php

declare(strict_types=1);

namespace App\QueryBuilder;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method User|null first($columns = ['*'])
 * @method User firstOrFail($columns = ['*'])
 * @method User findOrFail($id, $columns = ['*'])
 */
class UserBuilder extends Builder
{
    public function whereEmail(string $email): static
    {
        return $this->where('email', $email);
    }
}
