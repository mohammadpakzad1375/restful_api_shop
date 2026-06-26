<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Faq\FaqStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Faq\FaqUpdateApiRequest;
use App\Http\Services\BusinessLogic\Content\FaqService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Faq;
use OpenApi\Attributes as OA;

class FAQController extends Controller
{
    public function __construct(private FaqService $faqService)
    {
    }

    public function index()
    {
        $result = $this->faqService->showAllFaqs();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    public function store(FaqStoreApiRequest $request)
    {
        $result = $this->faqService->createFaq($request->validated());

        return ApiResponse::withResponseMessage('FAQ created successfully.')
            ->withResponseStatus(201)
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    public function show(Faq $faq)
    {
        return ApiResponse::withData($faq)
            ->build()
            ->response((bool) $faq);
    }

    public function update(FaqUpdateApiRequest $request, Faq $faq)
    {
        $result = $this->faqService->updateFaq($request->validated(), $faq);

        return ApiResponse::withResponseMessage('FAQ updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    public function destroy(Faq $faq)
    {
        $result = $this->faqService->deleteFaq($faq);

        return ApiResponse::withResponseMessage('FAQ deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
