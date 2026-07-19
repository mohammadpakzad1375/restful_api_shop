<?php

namespace App\Http\Requests\ApiRequests\Customer\Market\Comment;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class CommentStoreApiRequest extends ApiFormRequest
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
            'body' => ['required','string','max:600','min:5'],
            'parent_id' => ['nullable','exists:comments,id']
        ];
    }
}
