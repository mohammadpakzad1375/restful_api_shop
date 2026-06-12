<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\CommonDiscount;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class CommonDiscountUpdateApiRequest extends ApiFormRequest
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
            'title' => ['min:2','max:120'],
            'percentage' => ['numeric','min:1','max:100'],
            'discount_ceiling' => ['nullable','numeric'],
            'minimum_order_amount' => ['nullable','numeric'],
            'start_date' => ['numeric'],
            'end_date' => ['numeric'],
        ];
    }
}
