<?php

namespace App\Http\Services\Image;

class ImageToolsService
{
    protected $image;
    protected $exclusiveDirectory;
    protected $imageDirectory;
    protected $imageName;
    private $imageFormat;
    protected $finalImageDirectory;
    protected $finalImageName;

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getExclusiveDirectory()
    {
        return $this->exclusiveDirectory;
    }

    /**
     * @param mixed $exclusiveDirectory
     */
    public function setExclusiveDirectory($exclusiveDirectory): void
    {
        $this->exclusiveDirectory = trim($exclusiveDirectory, '/\\');
    }

    /**
     * @return mixed
     */
    public function getImageDirectory()
    {
        return $this->imageDirectory;
    }

    /**
     * @param mixed $imageDirectory
     */
    public function setImageDirectory($imageDirectory): void
    {
        $this->imageDirectory = trim($imageDirectory, '/\\');
    }

    /**
     * @return mixed
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param mixed $imageName
     */
    public function setImageName($imageName): void
    {
        $this->imageName = $imageName;
    }

    /**
     * @return mixed
     */
    public function getImageFormat()
    {
        return $this->imageFormat;
    }

    /**
     * @param mixed $imageFormat
     */
    private function setImageFormat($imageFormat): void
    {
        $this->imageFormat = $imageFormat;
    }

    /**
     * @return mixed
     */
    public function getFinalImageDirectory()
    {
        return $this->finalImageDirectory;
    }

    /**
     * @param mixed $finalImageDirectory
     */
    public function setFinalImageDirectory($finalImageDirectory): void
    {
        $this->finalImageDirectory = $finalImageDirectory;
    }

    /**
     * @return mixed
     */
    public function getFinalImageName()
    {
        return $this->finalImageName;
    }

    /**
     * @param mixed $finalImageName
     */
    public function setFinalImageName($finalImageName): void
    {
        $this->finalImageName = $finalImageName;
    }

    public function getImageAddress()
    {

        return $this->finalImageDirectory . DIRECTORY_SEPARATOR . $this->finalImageName;

    }

    protected function checkDirectory($imageDirectory)
    {

        if (!file_exists($imageDirectory)) {

//            mkdir($imageDirectory, 666, true);
            mkdir($imageDirectory, 0755, true);

        }
    }

    protected function provider()
    {

        //set properties
            $this->getImageDirectory() ?? $this->setImageDirectory(date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'));
            $this->getImageName() ?? $this->setImageName(time(). '_'. bin2hex(random_bytes(4)));
            $this->getImageFormat() ?? $this->setImageFormat($this->image->extension());


        //set final image directory
        $finalImageDirectory = empty($this->getExclusiveDirectory()) ? $this->getImageDirectory() : $this->getExclusiveDirectory() . DIRECTORY_SEPARATOR . $this->getImageDirectory();
        $this->setFinalImageDirectory($finalImageDirectory);


        //set final image name
        $this->setFinalImageName($this->getImageName() . '.' . $this->getImageFormat());


        //check and create final image directory
        $this->checkDirectory($this->getFinalImageDirectory());
    }

}
