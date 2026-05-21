<?php

namespace App\Http\Requests\ApiRequests\Admin\User\Customer;

use App\Http\Services\RestfulApi\Validation\ApiFormRequest;
use App\Rules\MobileRule;
use Illuminate\Validation\Rules\Password;

class CustomerStoreApiRequest extends ApiFormRequest
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
            'first_name' => ['required','min:2','max:120'],
            'last_name' => ['required','min:2','max:120'],
            'mobile' => ['required','digits:11','unique:users',new MobileRule()],
            'email' => ['required','string','email','unique:users'],
            'password' => ['required','confirmed',Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            'profile_photo_path' => ['nullable','image','mimes:png,jpg,jpeg'],
            'activation' => ['required','numeric','in:0,1'],
            'status' => ['required','numeric','in:0,1'],
        ];
    }
}
