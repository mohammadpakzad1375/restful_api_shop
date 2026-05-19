<?php

namespace App\Http\Controllers\Api\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Notify\SMS\SMSStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Notify\SMS\SMSUpdateApiRequest;
use App\Http\Resources\Notify\SMS\SMSApiResource;
use App\Http\Resources\Notify\SMS\SMSApiResourceCollection;
use App\Http\Services\BusinessLogic\Notify\SMSService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Notify\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    public function __construct(private SMSService $SMSService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->SMSService->showAllSMS();

        return ApiResponse::withData(SMSApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SMSStoreApiRequest $request)
    {
        $result = $this->SMSService->createSMS($request->validated());

        return ApiResponse::withResponseMessage('sms created successfully.')
            ->withData(SMSApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(SMS $sms)
    {
        return ApiResponse::withData(SMSApiResource::make($sms))
            ->build()
            ->response((bool) $sms);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SMSUpdateApiRequest $request, SMS $sms)
    {
        $result = $this->SMSService->updateSMS($request->validated(), $sms);

        return ApiResponse::withResponseMessage('sms updated successfully.')
            ->withData(SMSApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMS $sms)
    {
        $result = $this->SMSService->deleteSMS($sms);

        return ApiResponse::withResponseMessage('sms deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
