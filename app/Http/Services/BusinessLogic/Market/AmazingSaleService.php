<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\AmazingSale;

class AmazingSaleService
{
    public function showAllAmazingSaleDiscounts(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return AmazingSale::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createAmazingSale($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return AmazingSale::create($inputs);

        });
    }

    public function showAmazingSale(AmazingSale $amazingSale): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($amazingSale){

            return  $amazingSale->load('product');

        });
    }

    public function updateAmazingSale($inputs, AmazingSale $amazingSale): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $amazingSale) {

            $amazingSale->update($inputs);
           return $amazingSale;

        });
    }

    public function deleteAmazingSale(AmazingSale $amazingSale): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($amazingSale){

            $amazingSale->delete();

        });
    }
}
