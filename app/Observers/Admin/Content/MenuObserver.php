<?php

namespace App\Observers\Admin\Content;

use App\Models\Content\Menu;

class MenuObserver
{
    public function deleting(Menu $menu): void
    {
        $menu->children()->delete();
    }
}
