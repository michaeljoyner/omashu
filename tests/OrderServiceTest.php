<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Orders\Order;
use Omashu\Orders\OrderService;
use Omashu\Shipping\ShippingService;
use Omashu\Shopping\CartAccess;
use Omashu\Stock\Product;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 6:46 PM
 */
class OrderServiceTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function it_makes_a_correctly_formatted_order_number()
    {
        $service = new OrderService(new CartAccess(), new ShippingService());
        $now = new DateTime();
        $this->assertRegExp('/^'.$now->format('Ymd').'[a-zA-Z0-9]{4}/', $service->orderNumber());
    }

    /**
     *@test
     */
    public function given_a_valid_checkout_request_and_stocked_cart_it_makes_an_order()
    {
        $this->setUpCartWithProducts();
        $request = new MockCheckoutRequest();
        $cartAccess = new CartAccess();

        $service = new OrderService($cartAccess, new ShippingService());

        $service->placeOrder($request);

        $this->seeInDatabase('orders', [
            'name' => 'Mooz Joyner',
            'email' => 'mooz@example.com',
            'phone' => '0123456789',
            'address' => '123 Sesame Street',
            'customer_query' => 'Have a nice day',
            'total_price' => 500,
            'is_paid' => 0,
            'is_cancelled' => 0,
            'is_shipped' => 0
        ]);

        $order = Order::where('name', 'Mooz Joyner')->first();

        $this->seeInDatabase('order_items', [
            'order_id' => $order->id,
            'description' => '大蒜，薑，鹽。 | Product One - 10ml',
            'quantity' => 1,
            'unit_price' => 100,
            'product_id' => 1
        ]);

        $this->seeInDatabase('order_items', [
            'order_id' => $order->id,
            'description' => '大蒜，薑，鹽。 | Product Two - 10ml',
            'quantity' => 1,
            'unit_price' => 200,
            'product_id' => 2
        ]);
    }

    /**
     *@test
     */
    public function a_successfully_placed_order_has_a_shipping_fee()
    {
        $this->setUpCartWithProducts();
        $request = new MockCheckoutRequest();
        $service = new OrderService(new CartAccess(), new ShippingService());

        $service->placeOrder($request);
        $order = Order::where('name', 'Mooz Joyner')->first();

        $this->assertEquals(200, $order->shipping_fee);

    }

    /**
     *@test
     */
    public function it_empties_the_cart_after_a_successful_order()
    {
        $this->setUpCartWithProducts();
        $request = new MockCheckoutRequest();
        $cartAccess = new CartAccess();

        $service = new OrderService($cartAccess, new ShippingService());

        $service->placeOrder($request);

        $cartAccess = new CartAccess();
        $this->assertCount(0, $cartAccess->getCartContents());
    }

    protected function setUpCartWithProducts()
    {
        $cartAccess = new CartAccess();
        $product1 = factory(Product::class)->create(['name' => 'Product One', 'quantifier' => '10ml', 'price' => 100]);
        $product2 = factory(Product::class)->create(['name' => 'Product Two', 'quantifier' => '10ml', 'price' => 200]);

        $cartAccess->addProductToCart($product1, 1);
        $cartAccess->addProductToCart($product2, 1);
    }

}

class MockCheckoutRequest {
    public $name = 'Mooz Joyner';
    public $phone = '0123456789';
    public $email = 'mooz@example.com';
    public $address = '123 Sesame Street';
    public $customer_query = 'Have a nice day';
}