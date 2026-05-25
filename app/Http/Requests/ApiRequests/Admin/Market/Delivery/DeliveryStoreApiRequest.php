<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Delivery;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class DeliveryStoreApiRequest extends ApiFormRequest
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
            'amount' => ['required','numeric'],
            'delivery_time' => ['required','integer'],
            'delivery_time_unit' => ['required','string'],
        ];
    }
}
