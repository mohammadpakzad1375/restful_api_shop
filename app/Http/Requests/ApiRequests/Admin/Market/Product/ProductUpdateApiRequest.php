<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Product;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class ProductUpdateApiRequest extends ApiFormRequest
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
            'price' => ['numeric'],
            'category_id' => ['integer','exists:product_categories,id'],
            'brand_id' => ['nullable','integer','exists:brands,id'],
            'published_at' => ['numeric'],
            'image' => ['image','mimes:png,jpg,jpeg,gif'],
            'status' => ['numeric','in:0,1'],
            'marketable' => ['numeric','in:0,1'],
            'weight' => ['numeric'],
            'length' => ['numeric'],
            'width' => ['numeric'],
            'height' => ['numeric'],
            'tags' => ['string'],
            'introduction' => ['string','min:5']
        ];
    }
}
