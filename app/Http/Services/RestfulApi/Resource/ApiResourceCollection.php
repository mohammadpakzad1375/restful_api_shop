<?php

namespace App\Http\Services\RestfulApi\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResourceCollection extends ResourceCollection
{
    protected array $responseBody = [];

    public function withBody(array $body): static
    {
        $this->responseBody = $body;

        return $this;
    }

    public function toResponse($request): \Illuminate\Http\JsonResponse
    {
        $paginatedResponse = parent::toResponse($request);

        $data = json_decode($paginatedResponse->getContent(), true);

        return response()->json([
            ...$this->responseBody,
            ...$data,
        ], $paginatedResponse->getStatusCode());
    }

    public function paginationInformation($request, $paginated, $default)
    {
        return [
            'meta' => [
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'to' => $this->lastItem(),
                'total' => $this->total(),
            ],

            'links' => [
                'first' => $this->url(1),
                'last' => $this->url($this->lastPage()),
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
        ];
    }
}
