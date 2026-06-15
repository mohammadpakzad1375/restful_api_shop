<?php

namespace App\Http\Services\BusinessLogic\Notify;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Notify\Email;
use App\Models\Notify\SMS;

class EmailService
{
    public function showAllEmails(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Email::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createEmail($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $email = Email::create($inputs);

            return $email->refresh();

        });
    }

    public function updateEmail($inputs, Email $email): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $email){

            $email->update($inputs);
            return $email->refresh();

        });
    }

    public function deleteEmail(Email $email): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($email){

            $email->delete();

        });
    }
}
