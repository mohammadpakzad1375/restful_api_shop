<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\AttributeValue;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class AttributeValueUpdateApiRequest extends ApiFormRequest
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
            'value' => ['required','string','max:120'],
            'price_increase' => ['required','numeric'],
            'category_attribute_id' => ['required','integer','exists:category_attributes,id'],
            'product_id' => ['required','integer','exists:products,id'],
        ];
    }
}
