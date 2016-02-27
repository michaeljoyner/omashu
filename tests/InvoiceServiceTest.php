<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Shopping\CartAccess;
use Omashu\Stock\Product;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/23/16
 * Time: 12:48 PM
 */
class InvoiceServiceTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function it_creates_an_invoice_from_a_repository_or_array_of_cart_items()
    {
        $this->setUpCartWithProducts();
        $invoiceService = new \Omashu\Invoicing\InvoiceService(new \Omashu\Shipping\ShippingService());
        $cartAccess = new CartAccess();
        $invoice = $invoiceService->createFromCart($cartAccess);

        $this->assertInstanceOf(\Omashu\Invoicing\Invoice::class, $invoice);
        $this->assertCount(2, $invoice->items);
        $this->assertEquals(300, $invoice->subtotal);
    }

    /**
     * @test
     */
    public function it_includes_the_correct_shipping_fee_on_the_invoice()
    {
        $this->setUpCartWithProducts();
        $invoiceService = new \Omashu\Invoicing\InvoiceService(new \Omashu\Shipping\ShippingService());
        $cartAccess = new CartAccess();
        $invoice = $invoiceService->createFromCart($cartAccess);

        $this->assertEquals(200, $invoice->shipping);
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