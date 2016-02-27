<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/23/16
 * Time: 10:27 PM
 */

namespace Omashu\Shipping;


class ShippingService
{

    private $shippingRule;

    public function __construct($shippingRule = null)
    {
        if(is_null($shippingRule)) {
            $this->shippingRule = ShippingRule::where('name', 'general')->first();
        } else {
            $this->shippingRule = $shippingRule;
        }

        if(! $this->shippingRule || ! $this->shippingRule instanceof ShippingRule) {
            $this->shippingRule = $this->createBasicShippingRule();
        }


    }

    public function getRate()
    {
        return $this->shippingRule->rate;
    }

    public function getFreeAbove()
    {
        return $this->shippingRule->free_above;
    }

    public function getFeeForAmountOf($amount)
    {
        $fee = $amount > $this->getFreeAbove() ? 0 : $this->getRate();

        return intval($fee);
    }

    private function createBasicShippingRule()
    {
        return ShippingRule::create(['name' => 'general', 'rate' => 200, 'free_above' => 1000]);
    }

}