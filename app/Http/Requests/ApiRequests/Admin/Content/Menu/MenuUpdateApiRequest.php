<?php

namespace App\Http\Requests\ApiRequests\Admin\Content\Menu;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class MenuUpdateApiRequest extends ApiFormRequest
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
            'name' => ['string','min:2'],
            'parent_id' => ['nullable','exists:menus,id'],
//            use in production mode
//            'url' => ['url:https,http','active_url'],
            'url' => ['url:https,http'],
            'status' => ['numeric','in:0,1']
        ];
    }
}
