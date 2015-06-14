<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/10/15
 * Time: 10:38 AM
 */

namespace Omashu\Stock;


trait UsesAbsoluteUrlsTrait {

    protected function makeAbsoluteUrl($link)
    {
        if(starts_with($link, 'http://') || starts_with($link, 'https://')) {
            return $link;
        }

        return 'http://'.$link;
    }

}