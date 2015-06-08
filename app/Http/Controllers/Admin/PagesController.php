<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/5/15
 * Time: 9:46 AM
 */

namespace Omashu\Http\Controllers\Admin;


use Omashu\Http\Controllers\Controller;

class PagesController extends Controller {

    public function dashboard()
    {
        return 'admin dashboard';
    }

}