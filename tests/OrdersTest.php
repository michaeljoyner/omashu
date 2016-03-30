<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Orders\Order;
use Omashu\Orders\OrderItem;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/21/16
 * Time: 5:58 PM
 */
class OrdersTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_order_can_be_created()
    {
        $order = factory(Order::class)->make(['name' => 'Mooz Inc.']);

        $this->assertEquals('Mooz Inc.', $order->name);
    }

    /**
     * @test
     */
    public function an_order_item_can_be_added_to_an_order()
    {
        $order = factory(Order::class)->create();
        $orderItem = factory(OrderItem::class)->create(['description' => 'Crispy cheez']);

        $order->addItem($orderItem);

        $this->assertCount(1, $order->items);
        $this->assertEquals('Crispy cheez', $order->items->first()->description);
    }

    /**
     *@test
     */
    public function an_orders_paid_status_can_be_set()
    {
        $order = factory(Order::class)->create();

        $this->assertTogglesStatus($order, 'setPaidStatus', 'is_paid');
    }

    /**
     *@test
     */
    public function an_orders_shipped_status_can_be_set()
    {
        $order = factory(Order::class)->create();

        $this->assertTogglesStatus($order, 'setShippedStatus', 'is_shipped');
    }

    /**
     *@test
     */
    public function an_orders_cancelled_status_can_be_set()
    {
        $order = factory(Order::class)->create();

        $this->assertTogglesStatus($order, 'setCancelledStatus', 'is_cancelled');
    }

    /**
     * @test
     */
    public function an_order_has_a_status()
    {
        $order = factory(Order::class)->create();
        $this->assertEquals('open', $order->status());

        $order->setShippedStatus(true);
        $this->assertEquals('shipped', $order->status());

        $order->setCancelledStatus(true);
        $this->assertEquals('cancelled', $order->status());

        $order->setCancelledStatus(false);
        $order->setPaidStatus(true);
        $this->assertEquals('complete', $order->status());
    }

    /**
     *@test
     */
    public function an_order_can_be_archived_which_is_just_a_soft_deleted()
    {
        $order = factory(Order::class)->create();
        $this->assertNull($order->deleted_at, 'order should not have a deleted at timestamp');

        $order->archive();
        $this->assertNotNull($order->deleted_at, 'should have a deleted at timestamp');
    }

    /**
     *@test
     */
    public function an_order_can_be_restored()
    {
        $order = factory(Order::class)->create();
        $order->archive();

        $order->restore();
        $this->assertNull($order->deleted_at);
    }

    /**
     * @test
     */
    public function a_query_can_be_scoped_for_archived_orders_only()
    {
        $order = factory(Order::class)->create();
        $order2 = factory(Order::class)->create();
        $order3 = factory(Order::class)->create();
        $order2->archive();
        $order3->archive();
        $archived = Order::archived()->get();

        $this->assertCount(2, $archived);
    }

    protected function assertTogglesStatus($order, $toggleMethod, $toggleAttribute)
    {
        $this->assertFalse(!! $order->{$toggleAttribute});

        $order->{$toggleMethod}(true);
        $this->assertTrue(!! $order->{$toggleAttribute});

        $order->{$toggleMethod}(false);
        $this->assertFalse(!! $order->{$toggleAttribute});
    }

}