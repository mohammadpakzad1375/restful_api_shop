<?php

namespace App\Http\Services\BusinessLogic\Tools;

use Illuminate\Support\Facades\DB;

class TransactionalServiceWrapper
{
    public function __invoke(\Closure $action, \Closure $reject = null)
    {
        DB::beginTransaction();

        try {
            $actionResult = $action();

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            !is_null($reject) && $reject();
            return new ServiceResult(false, $th->getMessage());
        }

        return new ServiceResult(true, $actionResult);
    }
}
