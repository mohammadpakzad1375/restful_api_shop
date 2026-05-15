<?php

namespace App\Http\Services\RestfulApi\Resource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResourceCollection extends ResourceCollection
{
    public function paginationInformation($request, $paginated, $default)
    {
        return [
            'meta' => [
                'total' => $this->total(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'prev_page' => $this->currentPage() === 1 ? 1 : $this->currentPage() - 1,
                'next_page' => $this->currentPage() === $this->lastPage() ? $this->currentPage() : $this->currentPage() + 1,
                'last_page' => $this->lastPage(),
            ]
        ];
    }
}
