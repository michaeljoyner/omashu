<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/10/15
 * Time: 10:19 AM
 */

namespace Omashu\Services;


class ProductImageStorer extends FileStorer {

    protected $path = 'images/stockuploads/products/';

    protected $maxDimension = 400;

}