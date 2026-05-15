<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Faq\FaqStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Faq\FaqUpdateApiRequest;
use App\Http\Services\BusinessLogic\Content\FaqService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function __construct(private FaqService $faqService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->faqService->showAllFaqs();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqStoreApiRequest $request)
    {
        $result = $this->faqService->createFaq($request->validated());

        return ApiResponse::withResponseMessage('faq created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return ApiResponse::withData($faq)
            ->build()
            ->response((bool) $faq);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqUpdateApiRequest $request, Faq $faq)
    {
        $result = $this->faqService->updateFaq($request->validated(), $faq);

        return ApiResponse::withResponseMessage('faq updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $result = $this->faqService->deleteFaq($faq);

        return ApiResponse::withResponseMessage('faq deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
