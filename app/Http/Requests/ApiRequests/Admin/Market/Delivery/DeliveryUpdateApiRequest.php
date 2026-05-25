<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Delivery;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class DeliveryUpdateApiRequest extends ApiFormRequest
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
            'amount' => ['numeric'],
            'delivery_time' => ['integer'],
            'delivery_time_unit' => ['string'],
        ];
    }
}
