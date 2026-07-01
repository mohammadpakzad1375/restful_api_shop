<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\CategoryAttribute;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class CategoryAttributeUpdateApiRequest extends ApiFormRequest
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
            'name' => ['string','min:2','max:120'],
            'unit' => ['string','min:2','max:120'],
            'category_id' => ['integer','exists:product_categories,id'],
        ];
    }
}
