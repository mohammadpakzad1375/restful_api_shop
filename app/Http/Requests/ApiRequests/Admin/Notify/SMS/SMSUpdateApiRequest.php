<?php

namespace App\Http\Requests\ApiRequests\Admin\Notify\SMS;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class SMSUpdateApiRequest extends ApiFormRequest
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
            'title' => ['min:2','max:250'],
            'body' => ['max:600','min:5'],
            'published_at' => ['numeric'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
