<?php

namespace App\Http\Controllers\Api\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Setting\SettingUpdateApiRequest;
use App\Http\Services\BusinessLogic\Setting\SettingService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private SettingService $settingService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->settingService->showOrCreateSetting();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingUpdateApiRequest $request, Setting $setting)
    {
        $result = $this->settingService->updateSetting($request->validated(), $setting);

        return ApiResponse::withResponseMessage('Setting updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }
}
