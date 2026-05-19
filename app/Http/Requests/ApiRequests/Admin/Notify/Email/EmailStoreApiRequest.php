<?php

namespace App\Http\Requests\ApiRequests\Admin\Notify\Email;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class EmailStoreApiRequest extends ApiFormRequest
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
            'subject' => ['required','min:2','max:250'],
            'body' => ['required','max:600','min:5'],
            'published_at' => ['required','numeric'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
