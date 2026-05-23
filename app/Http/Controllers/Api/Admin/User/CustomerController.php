<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\User\Customer\CustomerStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\User\Customer\CustomerUpdateApiRequest;
use App\Http\Resources\User\Customer\CustomerApiResource;
use App\Http\Resources\User\Customer\CustomerApiResourceCollection;
use App\Http\Services\BusinessLogic\User\CustomerUserService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\User;

class CustomerController extends Controller
{
    public function __construct(private CustomerUserService $customerUserService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->customerUserService->showAllCustomers();

        return ApiResponse::withData(CustomerApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreApiRequest $request)
    {
        $result = $this->customerUserService->createCustomer($request->validated());

        return ApiResponse::withResponseMessage('Customer created successfully.')
            ->withData(CustomerApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $customer)
    {
        return ApiResponse::withData(CustomerApiResource::make($customer))
            ->build()
            ->response((bool) $customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateApiRequest $request, User $customer)
    {
        $result = $this->customerUserService->updateCustomer($request->validated(), $customer);

        return ApiResponse::withResponseMessage('Customer updated successfully.')
            ->withData(CustomerApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        $result = $this->customerUserService->deleteCustomer($customer);

        return ApiResponse::withResponseMessage('Customer deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
