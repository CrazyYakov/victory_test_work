<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Presentation\Controllers\V1;

use Illuminate\Contracts\Support\Responsable;
use OrderManagement\Auth\Application\Actions\CreateUserActions;
use OrderManagement\Auth\Presentation\Requests\V1\UserRegistrationRequest;
use OrderManagement\Common\Presentation\Responses\CreatedResponse;

readonly class UserRegistrationController
{
    public function __construct(
        private CreateUserActions $createUserActions
    ) {}

    public function __invoke(UserRegistrationRequest $request): Responsable
    {
        call_user_func($this->createUserActions, $request->email, $request->password);

        return new CreatedResponse();
    }
}
