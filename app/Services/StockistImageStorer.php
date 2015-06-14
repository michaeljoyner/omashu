<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/10/15
 * Time: 10:20 AM
 */

namespace Omashu\Services;


class StockistImageStorer extends FileStorer {

    protected $path = 'images/stockuploads/stockists/';

    protected $maxDimension = 400;

}