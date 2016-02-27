<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Shipping\ShippingRule;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/23/16
 * Time: 10:40 PM
 */
class ShippingRuleControllerTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function shipping_fees_for_an_existing_rule_can_be_edited()
    {
        $rule = factory(ShippingRule::class)->create(['name' => 'general']);

        $this->asLoggedInUser();

        $this->visit('/admin/shippingrules/'.$rule->id.'/edit')
            ->type(400, 'rate')
            ->type('900', 'free_above')
            ->press('Set Rates')
            ->seeInDatabase('shipping_rules', [
                'id' => $rule->id,
                'rate' => 400,
                'free_above' => 900
            ]);
    }

}