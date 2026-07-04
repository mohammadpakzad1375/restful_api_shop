<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Copan;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class CopanStoreApiRequest extends ApiFormRequest
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
            'amount' => [(request()->amount_type == 0 ? 'max:100' : 'min:1'),'required','integer'],
            'amount_type' => ['required','integer','in:0,1'],
            'discount_ceiling' => ['nullable','integer'],
            'user_id' => ['nullable','integer','exists:users,id'],
            'start_date' => ['required','integer'],
            'end_date' => ['required','integer'],
            'status' => ['integer','in:0,1']
        ];
    }
}
