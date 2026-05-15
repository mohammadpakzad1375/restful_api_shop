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
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->menuService->showAllMenus();

        return ApiResponse::withData(MenuApiResourceCollection::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuStoreApiRequest $request)
    {
        $result = $this->menuService->createMenu($request->validated());

        return ApiResponse::withResponseMessage('menu created successfully.')
            ->withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        $result = $this->menuService->showMenu($menu);

        return ApiResponse::withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuUpdateApiRequest $request, Menu $menu)
    {
        $result = $this->menuService->updateMenu($request->validated(), $menu);

        return ApiResponse::withResponseMessage('menu updated successfully.')
            ->withData(MenuApiResource::make($result->data))
            ->build()
            ->response($result->success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $result = $this->menuService->deleteMenu($menu);

        return ApiResponse::withResponseMessage('menu deleted successfully.')
            ->build()
            ->response($result->success);
    }
}
