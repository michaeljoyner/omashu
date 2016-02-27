<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 6:02 PM
 */
class OrderItemsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_order_item_can_be_created()
    {
        $item = factory(\Omashu\Orders\OrderItem::class)->create(['description' => 'Crispy cheez']);

        $this->assertEquals('Crispy cheez', $item->description);
    }

}