<?php

namespace App\Http\Requests\ApiRequests\Admin\Content\Post;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class PostUpdateApiRequest extends ApiFormRequest
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
            'summary' => ['max:300','min:5'],
            'body' => ['max:600','min:5'],
            'category_id' => ['numeric','exists:post_categories,id'],
            'tags' => ['string'],
//            'image' => [],
            'status' => ['in:0,1'],
            'commentable' => ['numeric','in:0,1'],
            'published_at' => ['numeric']
        ];
    }
}
