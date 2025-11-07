<?php

declare(strict_types=1);

namespace OrderManagement\Auth\Presentation\Controllers\V1;


use Illuminate\Contracts\Support\Responsable;
use OrderManagement\Auth\Application\Actions\CreateTokenAction;
use OrderManagement\Auth\Infrastructure\Repositories\UserRepository;
use OrderManagement\Auth\Presentation\Requests\V1\UserAuthorizationRequest;
use OrderManagement\Common\Presentation\Responses\SuccessResponse;
use OrderManagement\Common\Presentation\Responses\UnprocessableResponse;

readonly class UserAuthorizationController
{
    public function __construct(
        private UserRepository $userRepository,
        private CreateTokenAction $createTokenAction
    ) {}

    public function __invoke(UserAuthorizationRequest $request): Responsable
    {
        $user = $this->userRepository
            ->byEmail($request->email);

        if (! $user->checkPassword($request->password)) {
            return new UnprocessableResponse();
        }

        $token = call_user_func($this->createTokenAction, $user);

        return new SuccessResponse([
            'token' => $token,
        ]);
    }
}
