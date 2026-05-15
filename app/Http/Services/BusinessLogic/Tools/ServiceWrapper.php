<?php

namespace App\Http\Services\BusinessLogic\Tools;


class ServiceWrapper
{
    public function __invoke(\Closure $action, \Closure $reject = null)
    {
        try {
            $actionResult = $action();

        } catch (\Throwable $th) {

            !is_null($reject) && $reject();
            return new ServiceResult(false, $th->getMessage());
        }

        return new ServiceResult(true, $actionResult);
    }
}
