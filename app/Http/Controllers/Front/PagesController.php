<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/3/15
 * Time: 10:41 AM
 */

namespace Omashu\Http\Controllers\Front;


use Omashu\Http\Controllers\Controller;
use Omashu\Stock\Brand;
use Omashu\Stock\Stockist;

class PagesController extends Controller {

    public function homePage()
    {
        $brands = Brand::all();
        return view('front.pages.home')->with(compact('brands'));
    }

    public function brandsPage()
    {
        $brands = Brand::all();
        return view('front.pages.brands')->with(compact('brands'));
    }

    public function productsPage()
    {
        $brands = Brand::with(['categories' => function($query)
        {
            $query->with(['products' => function($q) {
                $q->where('is_available', 1);
            }]);
        }])->get();
        return view('front.pages.products')->with(compact('brands'));
    }

    public function stockistsPage()
    {
        $stockists = Stockist::all();
        return view('front.pages.stockists')->with(compact('stockists'));
    }

}