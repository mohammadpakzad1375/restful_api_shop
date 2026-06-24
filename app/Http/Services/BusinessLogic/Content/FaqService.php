<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Faq;

class FaqService
{
    public function showAllFaqs(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Faq::orderBy('created_at','desc')->get();

        });
    }

    public function createFaq($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return Faq::create($inputs);
        });
    }

    public function updateFaq($inputs, Faq $faq): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $faq){

            $faq->update($inputs);
            return $faq;

        });
    }

    public function deleteFaq(Faq $faq): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($faq){

            $faq->delete();

        });
    }
}
