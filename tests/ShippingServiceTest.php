<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Shipping\ShippingRule;
use Omashu\Shipping\ShippingService;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/23/16
 * Time: 10:18 PM
 */
class ShippingServiceTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_shipping_service_can_give_the_shipping_rate_and_free_above_fee()
    {
        $this->setUpGeneralShippingRule();
        $shippingService = new ShippingService();

        $this->assertEquals(200, $shippingService->getRate());
        $this->assertEquals(1000, $shippingService->getFreeAbove());
    }

    /**
     *@test
     */
    public function it_can_give_the_shipping_fee_for_a_given_order_price()
    {
        $shippingService = new ShippingService($this->setUpGeneralShippingRule());

        $this->assertEquals(200, $shippingService->getFeeForAmountOf(500));
        $this->assertEquals(0, $shippingService->getFeeForAmountOf(2000));
    }

    /**
     * @return mixed
     */
    private function setUpGeneralShippingRule()
    {
        return factory(ShippingRule::class)->create(['name' => 'general', 'rate' => 200, 'free_above' => 1000]);
    }

}