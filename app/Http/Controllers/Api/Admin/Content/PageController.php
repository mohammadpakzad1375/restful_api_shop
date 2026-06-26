<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Page\PageStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Page\PageUpdateApiRequest;
use App\Http\Services\BusinessLogic\Content\PageService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Page;
use OpenApi\Attributes as OA;

class PageController extends Controller
{
    public function __construct(private PageService $pageService)
    {
    }

    public function index()
    {
        $result = $this->pageService->showAllPages();

        return ApiResponse::withData($result->data)
            ->build()
            ->response($result->success);
    }

    public function store(PageStoreApiRequest $request)
    {
        $result = $this->pageService->createPage($request->validated());

        return ApiResponse::withResponseMessage('Page created successfully.')
            ->withResponseStatus(201)
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    public function show(Page $page)
    {
        return ApiResponse::withData($page)
            ->build()
            ->response((bool) $page);
    }

    public function update(PageUpdateApiRequest $request, Page $page)
    {
        $result = $this->pageService->updatePage($request->validated(), $page);

        return ApiResponse::withResponseMessage('Page updated successfully.')
            ->withData($result->data)
            ->build()
            ->response($result->success);
    }

    public function destroy(Page $page)
    {
        $result = $this->pageService->deletePage($page);

        return ApiResponse::withResponseMessage('Page deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
