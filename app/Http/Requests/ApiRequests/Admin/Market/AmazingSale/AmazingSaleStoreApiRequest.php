<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\AmazingSale;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class AmazingSaleStoreApiRequest extends ApiFormRequest
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
            'percentage' => ['required','numeric','min:1','max:100'],
            'start_date' => ['required','numeric'],
            'end_date' => ['required','numeric'],
            'product_id' => ['required','integer','exists:products,id'],
        ];
    }
}
