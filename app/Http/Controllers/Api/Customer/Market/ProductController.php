<?php

namespace App\Http\Controllers\Api\Customer\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\BusinessLogic\Market\CustomerProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private CustomerProductService $customerProductService)
    {
    }

    public function product(Request $request)
    {

    }

    public function addComment(Request $request)
    {

    }
}
