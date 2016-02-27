<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 12:55 PM
 */

namespace Omashu\Shopping;


use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Model;
use Omashu\Stock\Product;

class CartAccess
{
    public function addProductToCart($productId, $quantity)
    {
        if($productId instanceof Model) {
            $product = $productId;
        } else {
            $product = Product::findOrFail($productId);
        }

        $name = $product->zh_name . ' / ' . $product->name;

        Cart::add($product->id, $name, $quantity, $product->price, ['image_src' => $product->coverPic('thumb')]);
    }

    public function updateRow($rowid, $quantity)
    {
        return Cart::update($rowid, $quantity);
    }

    public function countProducts()
    {
        return Cart::count(false);
    }

    public function countItems()
    {
        return Cart::count(true);
    }

    public function getCartContents()
    {
        return Cart::content()->values();
    }

    public function removeProduct($rowid)
    {
        return Cart::remove($rowid);
    }

    public function totalPrice()
    {
        return Cart::total();
    }

    public function emptyCart()
    {
        return Cart::destroy();
    }

    public function hasRow($rowid)
    {
        $row = Cart::get($rowid);

        return !! $row;
    }
}