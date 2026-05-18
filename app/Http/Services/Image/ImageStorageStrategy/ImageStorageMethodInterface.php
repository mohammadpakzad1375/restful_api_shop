<?php

namespace App\Http\Services\Image\ImageStorageStrategy;

interface ImageStorageMethodInterface
{
    public function store($image, string $imageDirectory, string $imageName): bool;

    public function delete(string $imagePath): bool;
}
