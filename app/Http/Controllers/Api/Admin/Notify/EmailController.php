<?php

namespace App\Http\Controllers\Api\Admin\Notify;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Notify\Email\EmailStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Notify\Email\EmailUpdateApiRequest;
use App\Http\Resources\Notify\Email\EmailApiResource;
use App\Http\Resources\Notify\Email\EmailApiResourceCollection;
use App\Http\Services\BusinessLogic\Notify\EmailService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Notify\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct(private EmailService $emailService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->emailService->showAllEmails();

        return ApiResponse::withData(EmailApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmailStoreApiRequest $request)
    {
        $result = $this->emailService->createEmail($request->validated());

        return ApiResponse::withResponseMessage('Email created successfully.')
            ->withData(EmailApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        return ApiResponse::withData(EmailApiResource::make($email))
            ->build()
            ->response((bool) $email);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailUpdateApiRequest $request, Email $email)
    {
        $result = $this->emailService->updateEmail($request->validated(), $email);

        return ApiResponse::withResponseMessage('Email updated successfully.')
            ->withData(EmailApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        $result = $this->emailService->deleteEmail($email);

        return ApiResponse::withResponseMessage('Email deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
