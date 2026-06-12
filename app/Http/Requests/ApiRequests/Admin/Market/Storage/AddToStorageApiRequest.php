<?php

namespace App\Http\Requests\ApiRequests\Admin\Market\Storage;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class AddToStorageApiRequest extends ApiFormRequest
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
            'receiver' => ['required','string','min:2','max:120'],
            'deliverer' => ['required','string','min:2','max:120'],
            'marketable_number' => ['required','numeric'],
            'description' => ['string','max:500','min:2']
        ];
    }
}
