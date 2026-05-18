<?php

namespace App\Http\Services\Image;

use App\Http\Services\Image\ImageNameGeneratorStrategy\ImageNameGeneratorMethodInterface;
use App\Http\Services\Image\ImageStorageStrategy\ImageStorageMethodInterface;

class ImageService extends ImageToolsService
{
    private ImageNameGeneratorMethodInterface $nameGeneratorMethod;
    private ImageStorageMethodInterface $storageMethod;
    public function __construct(ImageNameGeneratorMethodInterface $nameGeneratorMethod, ImageStorageMethodInterface $storageMethod)
    {
        $this->nameGeneratorMethod = $nameGeneratorMethod;
        $this->storageMethod = $storageMethod;
    }

    public function save($image): false|string
    {
        $this->setImage($image);
        $this->setImageName($this->nameGeneratorMethod->generate($image));
        $this->provider();

        $result = $this->storageMethod->store($image, $this->getFinalImageDirectory(), $this->getFinalImageName());

        return $result ? $this->getImageAddress() : false;
    }

    public function deleteImage($imagePath): bool
    {
        return $this->storageMethod->delete($imagePath);
    }
}
