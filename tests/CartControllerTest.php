<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Shopping\CartAccess;
use Omashu\Stock\Product;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 3:24 PM
 */
class CartControllerTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_collection_of_cart_items_can_be_fetched_by_http_get()
    {
        $this->setUpCartWithProducts();

        $response = $this->call('GET', 'api/cart');
        $this->assertEquals(200, $response->status());
        $this->assertCount(2, json_decode($response->getContent(), true));

        $this->seeJson([
            'price' => 100
        ]);
        $this->seeJson([
            'price' => 200
        ]);
    }

    /**
     *@test
     */
    public function it_returns_a_summary_of_the_cart_to_a_get_request()
    {
        $this->setUpCartWithProducts();

        $response = $this->call('GET', '/api/cart/summary');
        $this->assertEquals(200, $response->status());

        $this->seeJson([
            'items' => 2,
            'products' => 2,
            'total' => 300.00
        ]);
    }

    /**
     *@test
     */
    public function a_product_can_be_added_to_cart_via_post_request()
    {
        $product = factory(Product::class)->create(['name' => 'Cola', 'price' => 12345]);

        $this->withoutMiddleware();
        $response = $this->call('POST', '/api/cart', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        $this->assertEquals(200, $response->status());

        $cartAccess = new CartAccess();
        $this->assertEquals(1, $cartAccess->countProducts());
        $this->assertEquals(12345, $cartAccess->getCartContents()->first()->price);
    }

    /**
     *@test
     */
    public function a_cart_rows_quantity_can_be_updated_by_put_request()
    {
        $this->setUpCartWithProducts();
        $cartAccess = new CartAccess();
        $cartRow = $cartAccess->getCartContents()->first();

        $this->withoutMiddleware();
        $response = $this->call('PUT', '/api/cart/'.$cartRow->rowid, [
            'quantity' => 5
        ]);
        $this->assertEquals(200, $response->status());

        $cartAccess = new CartAccess();
        $this->assertEquals(6, $cartAccess->countItems());
        $this->assertEquals(5, $cartAccess->getCartContents()->first()->qty);
    }

    /**
     *@test
     */
    public function a_put_request_with_an_invalid_rowid_is_duly_denied()
    {
        $this->setUpCartWithProducts();

        $this->withoutMiddleware();
        $response = $this->call('PUT', '/api/cart/'.'totally-not-real-123', [
            'quantity' => 5
        ]);
        $this->assertEquals(404, $response->status());
    }

    /**
     *@test
     */
    public function a_product_can_be_removed_from_the_cart_by_delete_request()
    {
        $this->setUpCartWithProducts();
        $cartAccess = new CartAccess();
        $cartRow = $cartAccess->getCartContents()->first();

        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/api/cart/' . $cartRow->rowid);
        $this->assertEquals(200, $response->status());

        $cartAccess = new CartAccess();
        $this->assertEquals(1, $cartAccess->countProducts());
    }

    /**
     *@test
     */
    public function it_provides_the_total_with_delivery_fee()
    {
        factory(\Omashu\Shipping\ShippingRule::class)->create(['name' => 'general']);
        $this->setUpCartWithProducts();

        $response = $this->call('GET', '/api/cart/totals');
        $this->assertEquals(200, $response->status());

        $this->seeJson([
            'subtotal' => 300,
            'shipping' => 200,
            'total' => 500
        ]);
    }

    protected function setUpCartWithProducts()
    {
        $cartAccess = new CartAccess();
        $product1 = factory(Product::class)->create(['name' => 'Product One', 'price' => 100]);
        $product2 = factory(Product::class)->create(['name' => 'Product Two', 'price' => 200]);

        $cartAccess->addProductToCart($product1, 1);
        $cartAccess->addProductToCart($product2, 1);
    }

}