<?php

namespace App\Http\Services\Image\ImageStorageStrategy\Factory;

use App\Http\Services\Image\ImageStorageStrategy\ImageStorageMethodInterface;
use App\Http\Services\Image\ImageStorageStrategy\PublicImageStorage;
use App\Http\Services\Image\ImageStorageStrategy\StorageImageStorage;
use Illuminate\Contracts\Container\BindingResolutionException;

class ImageStorageFactory
{
    /**
     * @throws BindingResolutionException
     */
    public function make(string $type): ImageStorageMethodInterface
    {
        return match ($type) {
            'public' => app()->make(PublicImageStorage::class),
            'storage' => app()->make(StorageImageStorage::class),
            default  => throw new \InvalidArgumentException("{$type} is invalid storage driver"),
        };
    }
}
