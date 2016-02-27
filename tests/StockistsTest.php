<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/7/15
 * Time: 11:27 PM
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laracasts\TestDummy\Factory as TestDummy;
use Omashu\Stock\Stockist;

class StockistsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_shows_all_stockists()
    {
        $this->asLoggedInUser();
        $stockists = factory(Stockist::class, 3)->create();

        $this->visit('admin/stockists')
            ->seePageIs('admin/stockists');

        $stockists->each(function ($stockist) {
            $this->see($stockist->name);
        });

    }

    /**
     * @test
     */
    public function it_adds_a_new_stockist()
    {
        $this->asLoggedInUser();

        $this->visit('admin/stockists/create')
            ->submitForm('Add Stockist', [
                'name' => 'SupeCity',
                'address' => '123 Sesame street',
                'zh_address' => '台中市南區工學一街182號',
                'phone' => '12345',
                'website' => 'city.com'
            ])
            ->seeInDatabase('stockists', [
                'name' => 'SupeCity',
                'address' => '123 Sesame street',
                'zh_address' => '台中市南區工學一街182號',
                'phone' => '12345',
                'website' => 'http://city.com'
            ]);
    }

    /**
     * @test
     */
    public function it_shows_a_single_stockist()
    {
        $this->asLoggedInUser();

        $stockist = factory(Stockist::class)->create();

        $this->visit('admin/stockists/' . $stockist->slug)
            ->seePageIs('admin/stockists/' . $stockist->slug)
            ->see($stockist->name)
            ->see($stockist->address)
            ->see($stockist->phone)
            ->see($stockist->website);
    }

    /**
     * @test
     */
    public function it_edits_an_existing_stockist()
    {
        $this->asLoggedInUser();

        $stockist = factory(Stockist::class)->create();

        $this->visit('admin/stockists/edit/' . $stockist->id)
            ->seePageIs('admin/stockists/edit/' . $stockist->id)
            ->type('Moozilicious', 'name')
            ->type('Nantun massive', 'address')
            ->press('Save Changes')
            ->seeInDatabase('stockists', [
                'id'      => $stockist->id,
                'name'    => 'Moozilicious',
                'address' => 'Nantun massive'
            ]);
    }

    /**
     *@test
     */
    public function a_stockist_may_be_deleted()
    {
        $this->asLoggedInUser();
        $stockist = factory(Stockist::class)->create();

        $this->withoutMiddleware();
        $response = $this->call('DELETE', '/admin/stockists/'.$stockist->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('stockists', ['id' => $stockist->id]);
    }

}