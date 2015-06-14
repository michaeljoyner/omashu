<?php

namespace Omashu\Services;

use Intervention\Image\ImageManager;

abstract class FileStorer
{
    protected $path = 'images/stockuploads/';

    protected $maxDimension = 400;

    /**
     * @var ImageManager
     */
    protected $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function storeImage($image)
    {
        $path = $this->getImagePath($image->getClientOriginalExtension());
        $resizeDimensions = $this->getResizeDimensions($image);
        $this->imageManager->make($image)
            ->resize($resizeDimensions['width'], $resizeDimensions['height'])
            ->save(public_path().$path);

        return $path;
    }

    protected function getImagePath($extension)
    {
        $now = new \DateTime();
        $prefix = $now->format('M_Y_');
        return '/'.$this->path.$prefix.$now->getTimestamp().'.'.$extension;
    }

    protected function getResizeDimensions($image)
    {
        $originalDimensions = getimagesize($image);
        $originalWidth = $originalDimensions[0];
        $originalHeight = $originalDimensions[1];
        $resizeDimensions = [];

        if($originalWidth < $this->maxDimension && $originalHeight < $this->maxDimension) {
            return [
                'width' => $originalWidth,
                'height' => $originalHeight
            ];
        }

        if($originalWidth >= $originalHeight) {
            $resizeDimensions['width'] = $this->maxDimension;
            $resizeDimensions['height'] = $originalHeight / $originalWidth * $this->maxDimension;
        } else {
            $resizeDimensions['height'] = $this->maxDimension;
            $resizeDimensions['width'] = $originalWidth / $originalHeight * $this->maxDimension;
        }

        return $resizeDimensions;
    }
}
