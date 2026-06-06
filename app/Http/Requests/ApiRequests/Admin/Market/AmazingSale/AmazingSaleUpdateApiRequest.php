<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\AmazingSale;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class AmazingSaleUpdateApiRequest extends ApiFormRequest
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
            'percentage' => ['numeric','min:1','max:100'],
            'start_date' => ['numeric'],
            'end_date' => ['numeric'],
            'product_id' => ['numeric','exists:products,id'],
        ];
    }
}
