<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Services\BusinessLogic\Market\HomeService;
use App\Http\Services\RestfulApi\ApiResponse\ApiResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private HomeService $homeService;
    private ApiResponse $apiResponse;

    public function __construct(HomeService $homeService, ApiResponse $apiResponse)
    {
        $this->homeService = $homeService;
        $this->apiResponse = $apiResponse;
    }


    public function home(Request $request)
    {
        $result = $this->homeService->home();

        if ($result->data['success'] && $result->success){

            $data = collect($result->data['data'])
                ->map(fn ($products) => ProductApiResource::collection($products))
                ->all();

            $this->apiResponse->setResponseMessage('Home data retrieved successfully.');
            $this->apiResponse->setData($data);

            return $this->apiResponse->response(true);

        } else {

            return $this->apiResponse->response(false);
        }

    }
}
