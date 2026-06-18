<?php

namespace App\Http\Services\BusinessLogic\Market;

use App\Events\Admin\Market\Copan\CopanCreated;
use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Market\Copan;

class CopanService
{
    public function showAllCopanDiscounts(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Copan::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createCopan($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            $copan = Copan::create($inputs);
            $copan->refresh();

            CopanCreated::dispatch($copan);

            return $copan;

        });
    }

    public function showCopan(Copan $copan): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($copan){

            return  $copan->load('user');

        });
    }

    public function updateCopan($inputs, Copan $copan): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $copan) {

            $copan->update($inputs);
            return $copan->refresh();

        });
    }

    public function deleteCopan(Copan $copan): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($copan){

            $copan->delete();

        });
    }
}
