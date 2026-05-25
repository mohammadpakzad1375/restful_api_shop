<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\User\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();

        return ApiResponse::withData($permissions)
            ->build()
            ->response((bool) $permissions);
    }
}
