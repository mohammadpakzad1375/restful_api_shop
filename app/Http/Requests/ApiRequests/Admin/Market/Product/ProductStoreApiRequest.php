<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Product;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class ProductStoreApiRequest extends ApiFormRequest
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
            'introduction' => ['required','string','min:5'],
            'price' => ['required','numeric'],
            'category_id' => ['required','numeric','exists:product_categories,id'],
            'brand_id' => ['nullable','numeric','exists:brands,id'],
            'published_at' => ['required','numeric'],
            'image' => ['required','image','mimes:png,jpg,jpeg,gif'],
            'status' => ['numeric','in:0,1'],
            'marketable' => ['numeric','in:0,1'],
            'weight' => ['nullable','numeric'],
            'length' => ['nullable','numeric'],
            'width' => ['nullable','numeric'],
            'height' => ['nullable','numeric'],
            'tags' => ['required','string'],
        ];
    }
}
