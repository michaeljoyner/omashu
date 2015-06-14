<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/7/15
 * Time: 11:27 PM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class StockistsTest extends TestCase {

    /**
     * @test
     */
    public function it_shows_all_stockists()
    {
        $this->loginAsRegisteredUser();
        $stockists = [];

        foreach(range(1,3) as $index) {
            $stockists[] = TestDummy::create('Omashu\Stock\Stockist');
        }

        $this->visit('admin/stockists')
            ->andSeePageIs('admin/stockists');

        foreach($stockists as $stockist) {
            $this->see($stockist->name);
        }

    }

    /**
     * @test
     */
    public function it_adds_a_new_product()
    {
        $this->loginAsRegisteredUser();

        $stockistDetails = TestDummy::attributesFor('Omashu\Stock\Stockist');
        unset($stockistDetails['image_path']);
        $stockistDetails['website'] = 'http://'.$stockistDetails['website'];

        $this->visit('admin/stockists/create')
            ->andSubmitForm('Add Stockist', $stockistDetails)
            ->andSeeInDatabase('stockists', $stockistDetails);
    }

    /**
     * @test
     */
    public function it_shows_a_single_product()
    {
        $this->loginAsRegisteredUser();

        $stockist = TestDummy::create('Omashu\Stock\Stockist');

        $this->visit('admin/stockists/'.$stockist->slug)
            ->andSeePageIs('admin/stockists/'.$stockist->slug)
            ->andSee($stockist->name)
            ->andSee($stockist->address)
            ->andSee($stockist->phone)
            ->andSee($stockist->website);
    }

    /**
     * @test
     */
    public function it_edits_an_existing_stockist()
    {
        $this->loginAsRegisteredUser();

        $stockist = TestDummy::create('Omashu\Stock\Stockist');

        $this->visit('admin/stockists/edit/'.$stockist->id)
            ->andSeePageIs('admin/stockists/edit/'.$stockist->id)
            ->andType('Moozilicious', 'name')
            ->andType('Nantun massive', 'address')
            ->andPress('Save Changes')
            ->andSeeInDatabase('stockists', [
                'id' => $stockist->id,
                'name' => 'Moozilicious',
                'address' => 'Nantun massive'
            ]);
    }

    protected function loginAsRegisteredUser()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);
    }

}