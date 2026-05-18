<?php

namespace App\Providers;

use App\Http\Services\Image\ImageNameGeneratorStrategy\Factory\ImageNameGeneratorFactory;
use App\Http\Services\Image\ImageNameGeneratorStrategy\ImageNameGeneratorMethodInterface;
use App\Http\Services\Image\ImageStorageStrategy\Factory\ImageStorageFactory;
use App\Http\Services\Image\ImageStorageStrategy\ImageStorageMethodInterface;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            ImageNameGeneratorMethodInterface::class,
            fn ($app) => $app->make(ImageNameGeneratorFactory::class)->make(config('image.default_name_generator','timestamp'))
        );

        $this->app->singleton(
            ImageStorageMethodInterface::class,
            fn ($app) => $app->make(ImageStorageFactory::class)->make(config('image.default_storage_driver','public'))
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
