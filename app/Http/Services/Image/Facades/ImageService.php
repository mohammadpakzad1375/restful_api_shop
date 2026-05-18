<?php

namespace App\Http\Services\Image\Facades;

use Illuminate\Support\Facades\Facade;

class ImageService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'imageService';
    }
}
