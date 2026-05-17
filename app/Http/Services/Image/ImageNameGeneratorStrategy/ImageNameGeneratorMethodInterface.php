<?php

namespace App\Http\Services\Image\ImageNameGeneratorStrategy;

interface ImageNameGeneratorMethodInterface
{
    public function generate($image): string;
}
