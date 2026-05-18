<?php

namespace App\Http\Services\Image\ImageStorageStrategy;

use Illuminate\Support\Facades\Storage;

class StorageImageStorage implements ImageStorageMethodInterface
{
    public function store($image, string $imageDirectory, string $imageName): bool
    {
        $disk = Storage::disk('public');
        if ($imageDirectory !== '' && !$disk->exists($imageDirectory)) {
            $disk->makeDirectory($imageDirectory);
        }

        return (bool)Storage::disk('public')->putFileAs($imageDirectory, $image, $imageName);
    }

    public function delete(string $imagePath): bool
    {
        $disk = Storage::disk('public');

        if (!$disk->exists($imagePath)) {
            return false;
        }

        return $disk->delete($imagePath);
    }
}
