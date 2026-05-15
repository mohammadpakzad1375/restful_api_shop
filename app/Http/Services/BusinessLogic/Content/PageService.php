<?php

namespace App\Http\Services\BusinessLogic\Content;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Models\Content\Page;

class PageService
{
    public function showAllPages(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            return Page::orderBy('created_at','desc')->get();

        });
    }

    public function createPage($inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs){

            return Page::create($inputs);
        });
    }

    public function updatePage($inputs, Page $page): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $page){

            $page->update($inputs);
            return $page->refresh();

        });
    }

    public function deletePage(Page $page): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($page){

            $page->delete();

        });
    }
}
