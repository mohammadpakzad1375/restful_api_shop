<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\CommonDiscount;

class CommonDiscountService
{
    public function showAllCommonDiscounts(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return CommonDiscount::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createCommonDiscount($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $commonDiscount = CommonDiscount::create($inputs);
            return $commonDiscount->refresh();

        });
    }

    public function updateCommonDiscount($inputs, CommonDiscount $commonDiscount): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $commonDiscount) {

            $commonDiscount->update($inputs);
           return $commonDiscount->refresh();

        });
    }

    public function deleteCommonDiscount(CommonDiscount $commonDiscount): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($commonDiscount){

            $commonDiscount->delete();

        });
    }
}
