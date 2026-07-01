<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\ProductCategory;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class ProductCategoryUpdateApiRequest extends ApiFormRequest
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
            'description' => ['string','min:2','max:500'],
            'image' => ['image','mimes:png,jpg,jpeg,gif'],
            'show_in_menu' => ['integer','in:0,1'],
            'parent_id' => ['nullable','exists:product_categories,id'],
            'tags' => ['string'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
