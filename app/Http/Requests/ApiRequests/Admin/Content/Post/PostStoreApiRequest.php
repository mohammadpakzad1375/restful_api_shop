<?php

namespace App\Http\Requests\ApiRequests\Admin\Content\Post;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class PostStoreApiRequest extends ApiFormRequest
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
            'summary' => ['required','max:300','min:5'],
            'body' => ['required','max:600','min:5'],
            'category_id' => ['required','numeric','exists:post_categories,id'],
            'tags' => ['required','string'],
            'image' => ['required','image','mimes:png,jpg,jpeg,gif'],
            'status' => ['numeric','in:0,1'],
            'commentable' => ['required','numeric','in:0,1'],
            'published_at' => ['required','numeric']
        ];
    }
}
