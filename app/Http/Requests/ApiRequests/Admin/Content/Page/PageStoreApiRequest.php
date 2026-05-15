<?php

namespace App\Http\Requests\ApiRequests\Admin\Content\Page;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class PageStoreApiRequest extends ApiFormRequest
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
            'title' => ['required','min:2','max:250'],
            'body' => ['required','max:1000','min:5'],
            'tags' => ['required','string'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
