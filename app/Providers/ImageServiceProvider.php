<?php

namespace App\Providers;

use App\Http\Services\Image\ImageNameGeneratorStrategy\Factory\ImageNameGeneratorFactory;
use App\Http\Services\Image\ImageNameGeneratorStrategy\ImageNameGeneratorMethodInterface;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
