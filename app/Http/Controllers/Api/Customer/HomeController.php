<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Market\Product\ProductApiResource;
use App\Http\Services\BusinessLogic\Market\HomeService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private HomeService $homeService)
    {
    }

    public function home(Request $request)
    {
        $result = $this->homeService->home();

        $data = collect($result->data['data'])
            ->map(fn ($products) => ProductApiResource::collection($products))
            ->all();

        return ApiResponse::withData($data)
            ->build()
            ->response($result->success);
    }
}
