<?php

namespace App\Http\Resources\Notify\Notification;

use App\Http\Services\RestfulApi\Resource\ApiResourceCollection;
use Illuminate\Http\Request;


class NotificationApiResourceCollection extends ApiResourceCollection
{
    public $collects = NotificationApiResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

}
