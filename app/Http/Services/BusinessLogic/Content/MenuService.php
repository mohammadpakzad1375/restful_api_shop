<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Menu;

class MenuService
{
    public function showAllMenus(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Menu::orderBy('created_at','desc')->paginate(10);

        });
    }

    public function createMenu($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return Menu::create($inputs);

        });
    }

    public function showMenu(Menu $menu): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($menu){

            return  $menu->load(['parent','children']);

        });
    }

    public function updateMenu($inputs, Menu $menu): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $menu){

            $menu->update($inputs);
            return $menu;

        });
    }

    public function deleteMenu(Menu $menu): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($menu){

            $menu->delete();

        });
    }
}
