<?php

namespace App\Http\Requests\ApiRequests\Admin\User\Role;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class RoleStoreApiRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','min:2','max:120'],
            'description' => ['nullable','string','max:200'],
            'permissions' => ['array'],
            'permissions.*' => ['integer','exists:permissions,id'],
            'status' => ['numeric','in:0,1']
        ];
    }
}
