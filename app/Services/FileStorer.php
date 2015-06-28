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
        $processedImage = $this->process($image);
        $processedImage->save(public_path().$path);
        return $path;
    }

    protected function process($image) {
        $imageDimensions = $this->getImageDimensions($image);
        if($imageDimensions['width'] > $imageDimensions['height']) {
            $pos = 'top-left';
        } else {
            $pos = 'center';
        }
        $canvas = $this->imageManager->canvas($imageDimensions['longest'], $imageDimensions['longest']);
        return $canvas->insert($image, $pos)->resize($this->maxDimension, $this->maxDimension);
    }

    protected function getImagePath($extension)
    {
        $now = new \DateTime();
        $prefix = $now->format('M_Y_');
        return '/'.$this->path.$prefix.$now->getTimestamp().'.'.$extension;
    }

    protected function getImageDimensions($image) {
        $dim = getimagesize($image);
        return [
            'width' => $dim[0],
            'height' => $dim[1],
            'longest' => max($dim[0], $dim[1])
        ];
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
