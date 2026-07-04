<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\CommonDiscount;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class CommonDiscountStoreApiRequest extends ApiFormRequest
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
            'title' => ['required','min:2','max:120'],
            'percentage' => ['required','integer','min:1','max:100'],
            'discount_ceiling' => ['nullable','integer'],
            'minimum_order_amount' => ['nullable','integer'],
            'start_date' => ['required','integer'],
            'end_date' => ['required','integer'],
        ];
    }
}
