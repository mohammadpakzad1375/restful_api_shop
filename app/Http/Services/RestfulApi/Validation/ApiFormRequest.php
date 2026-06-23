<?php

namespace App\Http\Services\RestfulApi\Validation;

use App\Http\Services\RestfulApi\Facades\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponse::withSuccess(false)
                ->withResponseMessage('Validation failed.')
                ->withAppends(['errors' => $validator->errors()])
                ->withResponseStatus(422)
                ->build()
                ->response(true)
        );
    }
}
