<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/3/15
 * Time: 10:41 AM
 */

namespace Omashu\Http\Controllers\Front;


use Omashu\Http\Controllers\Controller;
use Omashu\Invoicing\InvoiceService;
use Omashu\Shipping\ShippingService;
use Omashu\Shopping\CartAccess;
use Omashu\Stock\Brand;
use Omashu\Stock\Product;
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
                $q->where('is_available', 1)->orderBy('updated_at', 'desc');
            }]);
        }])->get();
        return view('front.pages.products')->with(compact('brands'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('front.pages.product')->with(compact('product'));
    }

    public function stockistsPage()
    {
        $stockists = Stockist::all();
        return view('front.pages.stockists')->with(compact('stockists'));
    }

    public function cart(ShippingService $shippingService)
    {
        $freeShippingPrice = $shippingService->getFreeAbove();
        return view('front.pages.cart')->with(compact('freeShippingPrice'));
    }



}