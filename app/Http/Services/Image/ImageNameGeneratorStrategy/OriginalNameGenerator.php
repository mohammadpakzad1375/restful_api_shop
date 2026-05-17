<?php

namespace App\Http\Services\Image\ImageNameGeneratorStrategy;

class OriginalNameGenerator implements ImageNameGeneratorMethodInterface
{
    public function generate($image): string
    {
        return pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    }
}
