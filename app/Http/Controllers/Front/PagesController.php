<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/3/15
 * Time: 10:41 AM
 */

namespace Omashu\Http\Controllers\Front;


use Omashu\Http\Controllers\Controller;

class PagesController extends Controller {

    public function homePage()
    {
        return view('temphome');
    }

}