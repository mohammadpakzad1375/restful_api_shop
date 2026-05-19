<?php

namespace App\Http\Requests\ApiRequests\Admin\Setting;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;

class SettingUpdateApiRequest extends ApiFormRequest
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
            'title' => ['string','min:2','max:250'],
            'description' => ['string','max:300','min:5'],
            'keywords' => ['string','max:300','min:5'],
            'logo' => ['image','mimes:png,jpg,jpeg,gif'],
            'icon' => ['image','mimes:png,jpg,jpeg,gif'],
        ];
    }
}
