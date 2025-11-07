<?php

declare(strict_types=1);

namespace OrderManagement\Common\Presentation\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class UnprocessableResponse implements Responsable
{
    public function __construct(
        private ?array $data = null
    ) {}

    /**
     * @inheritDoc
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'success',
            'data' => $this->data,
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
