<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\ProductGallery;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class ProductGalleryStoreApiRequest extends ApiFormRequest
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
            'image' => ['required','image','mimes:png,jpg,jpeg,gif'],
            'product_id' => ['required','numeric','exists:products,id'],
        ];
    }
}
