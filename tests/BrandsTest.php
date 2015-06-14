<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/6/15
 * Time: 3:28 PM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class BrandsTest extends TestCase {

    /**
     * @test
     */
    public function it_shows_all_the_brands()
    {
        $this->loginAsRegisteredUser();
        $brands = [];

        foreach(range(1,3) as $index) {
            $brands[] = TestDummy::create('Omashu\Stock\Brand');
        }

        $this->visit('admin/brands');

        foreach($brands as $brand) {
            $this->see($brand->name);
        }
    }

    /**
     * @test
     */
    public function it_can_add_new_brands()
    {
        $this->loginAsRegisteredUser();

        $brandData = TestDummy::attributesFor('Omashu\Stock\Brand');
        unset($brandData['image_path']);
        $brandData['website'] = 'http://'.$brandData['website'];

        $this->visit('admin/brands/create')
            ->andSubmitForm('Add Brand', $brandData)
            ->andSeeInDatabase('brands', $brandData);
    }

    /**
     * @test
     */
    public function it_edits_an_existing_brand()
    {
        $this->loginAsRegisteredUser();

        $brand = TestDummy::create('Omashu\Stock\Brand');

        $this->visit('admin/brands/edit/'.$brand->id)
            ->andType('Mooz is super cool', 'tagline')
            ->andPress('Save Changes')
            ->andSeeInDatabase('brands', ['id' => $brand->id, 'tagline' => 'Mooz is super cool']);
    }

    /**
     * @test
     */
    public function it_shows_a_single_brand()
    {
        $this->loginAsRegisteredUser();

        $brand = TestDummy::create('Omashu\Stock\Brand');

        $this->visit('admin/brands/'.$brand->slug)
            ->andSee($brand->name)
            ->andSee($brand->description)
            ->andSeePageIs('admin/brands/'.$brand->slug);
    }

    protected function loginAsRegisteredUser()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);
    }

}