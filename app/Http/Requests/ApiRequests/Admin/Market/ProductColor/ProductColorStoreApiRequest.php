<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\ProductColor;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class ProductColorStoreApiRequest extends ApiFormRequest
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
            'color_name' => ['required','min:2','max:120'],
            'color_code' => ['required','string','max:7'],
            'price_increase' => ['required','numeric'],
            'product_id' => ['required','numeric','exists:products,id'],
            'status' => ['numeric','in:0,1']
        ];
    }
}
