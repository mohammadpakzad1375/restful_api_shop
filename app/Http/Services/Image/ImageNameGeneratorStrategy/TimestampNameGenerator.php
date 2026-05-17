<?php

namespace App\Http\Services\Image\ImageNameGeneratorStrategy;

class TimestampNameGenerator implements ImageNameGeneratorMethodInterface
{

    /**
     * @throws \Exception
     */
    public function generate($image): string
    {
        return time(). '_'. bin2hex(random_bytes(4));
    }
}
