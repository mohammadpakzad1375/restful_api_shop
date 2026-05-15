<?php

namespace App\Http\Requests\ApiRequests\Admin\Content\Faq;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class FaqUpdateApiRequest extends ApiFormRequest
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
            'question' => ['min:2','max:250'],
            'answer' => ['min:2','max:250'],
            'tags' => ['string'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
