<?php

namespace App\Http\Requests\ApiRequests\Admin\User\Customer;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;
use App\Rules\MobileRule;
use Illuminate\Validation\Rules\Password;

class CustomerUpdateApiRequest extends ApiFormRequest
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
            'first_name' => ['min:2','max:120'],
            'last_name' => ['min:2','max:120'],
            'mobile' => ['digits:11',new MobileRule()],
            'email' => ['string','email'],
            'password' => ['confirmed',Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'profile_photo_path' => ['nullable','image','mimes:png,jpg,jpeg'],
            'activation' => ['numeric','in:0,1'],
            'status' => ['numeric','in:0,1'],
        ];
    }
}
