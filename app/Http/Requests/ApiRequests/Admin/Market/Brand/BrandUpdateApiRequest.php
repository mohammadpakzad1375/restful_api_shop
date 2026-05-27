<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Brand;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class BrandUpdateApiRequest extends ApiFormRequest
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
            'persian_name' => ['string','min:2','max:120'],
            'original_name' => ['string','min:2','max:120'],
            'logo' => ['image','mimes:png,jpg,jpeg,gif'],
            'tags' => ['string'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
