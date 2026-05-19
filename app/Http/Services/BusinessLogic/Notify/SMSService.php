<?php

namespace App\Http\Services\BusinessLogic\Notify;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Notify\SMS;

class SMSService
{
    public function showAllSMS(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return SMS::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createSMS($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $sms = SMS::create($inputs);

            return $sms->refresh();

        });
    }

    public function updateSMS($inputs, SMS $sms): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $sms){

            $sms->update($inputs);
            return $sms->refresh();

        });
    }

    public function deleteSMS(SMS $sms): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($sms){

            $sms->delete();

        });
    }
}
