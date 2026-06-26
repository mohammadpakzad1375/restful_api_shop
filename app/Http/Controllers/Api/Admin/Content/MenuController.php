<?php

namespace App\Http\Controllers\Api\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequests\Admin\Content\Menu\MenuStoreApiRequest;
use App\Http\Requests\ApiRequests\Admin\Content\Menu\MenuUpdateApiRequest;
use App\Http\Resources\Content\Menu\MenuApiResource;
use App\Http\Resources\Content\Menu\MenuApiResourceCollection;
use App\Http\Services\BusinessLogic\Content\MenuService;
use App\Http\Services\RestfulApi\Facades\ApiResponse;
use App\Models\Content\Menu;
use OpenApi\Attributes as OA;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    public function index()
    {
        $result = $this->menuService->showAllMenus();

        return ApiResponse::withData(MenuApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function store(MenuStoreApiRequest $request)
    {
        $result = $this->menuService->createMenu($request->validated());

        return ApiResponse::withResponseMessage('Menu created successfully.')
            ->withResponseStatus(201)
            ->withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function show(Menu $menu)
    {
        $result = $this->menuService->showMenu($menu);

        return ApiResponse::withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }


    public function update(MenuUpdateApiRequest $request, Menu $menu)
    {
        $result = $this->menuService->updateMenu($request->validated(), $menu);

        return ApiResponse::withResponseMessage('Menu updated successfully.')
            ->withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    public function destroy(Menu $menu)
    {
        $result = $this->menuService->deleteMenu($menu);

        return ApiResponse::withResponseMessage('Menu deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
