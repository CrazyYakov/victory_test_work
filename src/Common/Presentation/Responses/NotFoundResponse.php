<?php

declare(strict_types=1);

namespace OrderManagement\Common\Presentation\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotFoundResponse implements Responsable
{

    public function __construct(
        private string $message,
        private ?array $data = null
    ) {}

    /**
     * @inheritDoc
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->message,
            'data' => $this->data,
        ], Response::HTTP_NOT_FOUND);
    }
}
