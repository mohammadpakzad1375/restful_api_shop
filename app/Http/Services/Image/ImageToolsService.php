<?php

namespace App\Http\Services\Image;

class ImageToolsService
{
    protected $image;
    protected $exclusiveDirectory;
    protected $imageDirectory;
    protected $imageName;
    protected $imageFormat;
    protected $finalImageDirectory;
    protected $finalImageName;

    /**
     * @param mixed $image
     */
    protected function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    protected function getExclusiveDirectory()
    {
        return $this->exclusiveDirectory;
    }

    /**
     * @param mixed $exclusiveDirectory
     */
    protected function setExclusiveDirectory($exclusiveDirectory): void
    {
        $this->exclusiveDirectory = trim($exclusiveDirectory, '/\\');
    }

    /**
     * @return mixed
     */
    protected function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    /**
     * @param mixed $imageDirectory
     */
    protected function setImageDirectory($imageDirectory): void
    {
        $this->imageDirectory = trim($imageDirectory, '/\\');
    }

    /**
     * @return mixed
     */
    protected function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    protected function setImageName($imageName): void
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    protected function getImageFormat()
    {
        return $this->imageFormat;
    }

    /**
     * @param mixed $imageFormat
     */
    protected function setImageFormat($imageFormat): void
    {
        $this->imageFormat = $imageFormat;
    }

    /**
     * @return mixed
     */
    protected function getFinalImageDirectory()
    {
        return $this->finalImageDirectory;
    }

    /**
     * @param mixed $finalImageDirectory
     */
    protected function setFinalImageDirectory($finalImageDirectory): void
    {
        $this->finalImageDirectory = $finalImageDirectory;
    }

    /**
     * @return mixed
     */
    protected function getFinalImageName()
    {
        return $this->finalImageName;
    }

    /**
     * @param mixed $finalImageName
     */
    protected function setFinalImageName($finalImageName): void
    {
        $this->finalImageName = $finalImageName;
    }

    protected function getImageAddress()
    {

        return $this->finalImageDirectory . DIRECTORY_SEPARATOR . $this->finalImageName;

    }

    protected function provider()
    {

        //set properties
            $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
            $this->getImageFormat() ?? $this->setImageFormat($this->image->extension());

        //set final image directory
        $finalImageDirectory = empty($this->getExclusiveDirectory()) ? $this->getImageDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory();
        $this->setFinalImageDirectory($finalImageDirectory);


        //set final image name
        $this->setFinalImageName($this->getImageName() . '.' . $this->getImageFormat());

    }

}
