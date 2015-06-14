<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/10/15
 * Time: 10:17 AM
 */

namespace Omashu\Services;


class CategoryImageStorer extends FileStorer {

    protected $path = 'images/stockuploads/categories/';

    protected $maxDimension = 400;

}