<?php

namespace App\Http\Services\BusinessLogic\Tools;

class ServiceResult
{
    public function __construct(public bool $success, public mixed $data = null)
    {
    }
}
