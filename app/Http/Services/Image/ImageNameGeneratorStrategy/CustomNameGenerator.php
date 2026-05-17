<?php

namespace App\Http\Services\Image\ImageNameGeneratorStrategy;

class CustomNameGenerator implements ImageNameGeneratorMethodInterface
{
    public function __construct(private readonly string $customName)
    {
    }
    public function generate($image): string
    {
        return $this->customName;
    }
}
