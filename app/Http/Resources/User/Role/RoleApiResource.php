<?php

namespace App\Http\Resources\User\Role;

use App\Http\Resources\User\Admin\AdminApiResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->whenLoaded('permissions', function () {

                return $this->permissions->map(function ($permission) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                    ];

                });
            }),
            'users' => $this->whenLoaded('users', function () {

                return AdminApiResourceCollection::make($this->users);
            }),
        ];
    }
}
