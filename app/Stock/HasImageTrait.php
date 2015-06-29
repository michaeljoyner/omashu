<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/9/15
 * Time: 11:56 PM
 */

namespace Omashu\Stock;


trait HasImageTrait {

    public function imageSrc()
    {
        if(isset($this->attributes['image_path'])) {
            return asset($this->attributes['image_path']);
        }

        return asset('images/stock/placeholder_image.jpg');
    }

}