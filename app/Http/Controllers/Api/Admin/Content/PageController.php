<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Page\PageStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Page\PageUpdateApiRequest;
use App\Http\Services\BusinessLogic\Content\PageService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(private PageService $pageService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->pageService->showAllPages();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreApiRequest $request)
    {
        $result = $this->pageService->createPage($request->validated());

        return ApiResponse::withResponseMessage('page created successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return ApiResponse::withData($page)
            ->build()
            ->response((bool) $page);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageUpdateApiRequest $request, Page $page)
    {
        $result = $this->pageService->updatePage($request->validated(), $page);

        return ApiResponse::withResponseMessage('page updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $result = $this->pageService->deletePage($page);

        return ApiResponse::withResponseMessage('page deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
