<?php

namespace App\Http\Services\Image\ImageStorageStrategy;

class PublicImageStorage implements ImageStorageMethodInterface
{
    public function store($image, string $imageDirectory, string $imageName): bool|string
    {
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0755, true);
        }

        return (bool)$image->move(public_path($imageDirectory), $imageName);
    }

    public function delete(string $imagePath): bool|string
    {
        if (file_exists($imagePath)) {

            return unlink($imagePath);

        } else {
            return false;
        }
    }
}
