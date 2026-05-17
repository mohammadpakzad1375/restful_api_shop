<?php

namespace App\Http\Services\Image\ImageNameGeneratorStrategy\Factory;

use App\Http\Services\Image\ImageNameGeneratorStrategy\CustomNameGenerator;
use App\Http\Services\Image\ImageNameGeneratorStrategy\ImageNameGeneratorMethodInterface;
use App\Http\Services\Image\ImageNameGeneratorStrategy\OriginalNameGenerator;
use App\Http\Services\Image\ImageNameGeneratorStrategy\TimestampNameGenerator;
use Illuminate\Contracts\Container\BindingResolutionException;

class ImageNameGeneratorFactory
{
    /**
     * @throws BindingResolutionException
     */
    public function make(string $type, ?string $customImageName = null): ImageNameGeneratorMethodInterface
    {
        return match ($type) {
            'customName'   => app()->make(CustomNameGenerator::class, [
                'customName' => $customImageName,
            ]),
            'originalName' => app()->make(OriginalNameGenerator::class),
            'timestamp' => app()->make(TimestampNameGenerator::class),
            default  => throw new \InvalidArgumentException("{$type} is invalid name generator"),
        };
    }
}
