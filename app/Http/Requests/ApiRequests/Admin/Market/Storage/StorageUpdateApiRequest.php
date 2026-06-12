<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Storage;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class StorageUpdateApiRequest extends ApiFormRequest
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
            'marketable_number' => ['numeric'],
            'sold_number' => ['numeric'],
            'frozen_number' => ['numeric']
        ];
    }
}
