<?php

namespace App\Http\Requests\ApiRequests\Admin\Content\PostCategory;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class PostCategoryStoreApiRequest extends ApiFormRequest
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
            'name' => ['required','string','min:2','max:120'],
            'description' => ['required','string','min:2','max:500'],
            'image' => ['required','image','mimes:png,jpg,jpeg,gif'],
            'tags' => ['required','string'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
