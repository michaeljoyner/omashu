<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/20/16
 * Time: 9:05 AM
 */

namespace Omashu\Stock;


trait HasCoverPicTrait
{
    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 250, 'h' => 250, 'fit' => 'crop'])
            ->performOnCollections('default');
        $this->addMediaConversion('web')
            ->setManipulations(['w' => 500, 'h' => 600])
            ->performOnCollections('default');
    }

    public function setCoverPic($file)
    {
        $this->clearMediaCollection();

        $this->addMedia($file)->preservingOriginal()->toMediaLibrary();
    }

    public function coverPic($size = 'thumb')
    {
        $mediaPic = $this->getMedia()->first();

        return $mediaPic ? $mediaPic->getUrl($size) : $this->imageSrc();
    }

    public function imageSrc()
    {
        if(isset($this->attributes['image_path'])) {
            return asset($this->attributes['image_path']);
        }

        return asset('images/stock/placeholder_image.jpg');
    }
}