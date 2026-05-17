<?php

namespace App\Http\Services\Image;

use App\Http\Services\Image\ImageNameGeneratorStrategy\ImageNameGeneratorMethodInterface;

class ImageService extends ImageToolsService
{
    public function __construct(private readonly ImageNameGeneratorMethodInterface $nameGeneratorMethod)
    {
    }

    public function save($image): false|string
    {
        $this->setImage($image);
        $this->setImageName($this->nameGeneratorMethod->generate($image));
        $this->provider();

        $result = $image->move(public_path($this->getFinalImageDirectory()),$this->getFinalImageName());

        return $result ? $this->getImageAddress() : false;
    }

    public function deleteImage($imagePath)
    {
        if (file_exists($imagePath)) {

            return unlink($imagePath);

        } else {
            return false;
        }
    }
}
