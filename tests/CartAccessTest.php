<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Shopping\CartAccess;
use Omashu\Stock\Product;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 12:49 PM
 */
class CartAccessTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function items_can_be_put_into_the_cart_via_a_cart_access()
    {
        $product = factory(Product::class)->create();
        $cartAccess = new CartAccess();

        $cartAccess->addProductToCart($product->id, 3);

        $this->assertEquals(1, $cartAccess->countProducts(), 'should have one product');
        $this->assertEquals(3, $cartAccess->countItems(), 'should have one product');
    }

    /**
     *@test
     */
    public function an_item_can_be_removed_from_the_cart_by_its_row_id()
    {
        $cartAccess = new CartAccess();
        $products = factory(Product::class, 2)->create();

        $products->each(function($product) use ($cartAccess) {
            $cartAccess->addProductToCart($product, 1);
        });

        $this->assertEquals(2, $cartAccess->countProducts());

        $cartContents = $cartAccess->getCartContents();
        $cartAccess->removeProduct($cartContents->first()->rowid);

        $this->assertEquals(1, $cartAccess->countProducts());
    }

    /**
     *@test
     */
    public function it_can_return_the_total_price_of_the_cart()
    {
        $cartAccess = new CartAccess();
        $products = factory(Product::class, 2)->create(['price' => 150]);

        $products->each(function($product) use ($cartAccess) {
            $cartAccess->addProductToCart($product, 1);
        });

        $this->assertEquals(300.00, $cartAccess->totalPrice());
    }

    /**
     *@test
     */
    public function it_can_empty_the_cart()
    {
        $cartAccess = new CartAccess();
        $products = factory(Product::class, 2)->create();

        $products->each(function($product) use ($cartAccess) {
            $cartAccess->addProductToCart($product, 1);
        });

        $cartAccess->emptyCart();

        $this->assertEquals(0, $cartAccess->countProducts());
    }

    /**
     *@test
     */
    public function it_can_update_the_quantity_for_a_given_row_id()
    {
        $cartAccess = new CartAccess();
        $products = factory(Product::class, 2)->create();

        $products->each(function($product) use ($cartAccess) {
            $cartAccess->addProductToCart($product, 1);
        });

        $this->assertEquals(2, $cartAccess->countItems());

        $row = $cartAccess->getCartContents()->first();
        $cartAccess->updateRow($row->rowid, 5);

        $this->assertEquals(6, $cartAccess->countItems());
    }

    /**
     *@test
     */
    public function it_can_check_if_a_row_with_a_given_row_id_exists()
    {
        $cartAccess = new CartAccess();
        $products = factory(Product::class, 2)->create();

        $products->each(function($product) use ($cartAccess) {
            $cartAccess->addProductToCart($product, 1);
        });

        $row = $cartAccess->getCartContents()->first();

        $this->assertTrue($cartAccess->hasRow($row->rowid));
        $this->assertFalse($cartAccess->hasRow('cookies'));
    }

}