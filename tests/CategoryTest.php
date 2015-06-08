<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/7/15
 * Time: 10:46 AM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class CategoryTest extends TestCase {

    /**
     * @test
     */
    public function it_adds_a_new_category_to_a_brand()
    {
        $this->loginAsRegisteredUser();

        $brand = TestDummy::create('Omashu\Stock\Brand');
        $categoryData = TestDummy::attributesFor('Omashu\Stock\Category');
        unset($categoryData['image_path']);
        unset($categoryData['brand_id']);

        $this->visit('admin/categories/create/'.$brand->id)
            ->andSubmitForm('Add Category', $categoryData);

        $this->seeInDatabase('categories', $categoryData);
    }

    /**
     * @test
     */
    public function it_shows_all_categories_for_a_brand()
    {
        $this->loginAsRegisteredUser();

        $brand = TestDummy::create('Omashu\Stock\Brand');
        $categories = [];

        foreach(range(1,3) as $index) {
            $categories[] = TestDummy::create('Omashu\Stock\Category', ['brand_id' => $brand->id]);
        }

        $this->visit('admin/brands/'.$brand->slug)
            ->andSeePageIs('admin/brands/'.$brand->slug);

        foreach($categories as $category) {
            $this->see($category->name);
        }
    }

    /**
     * @test
     */
    public function it_edits_an_existing_category()
    {
        $this->loginAsRegisteredUser();

        $category = TestDummy::create('Omashu\Stock\Category');

        $this->visit('admin/categories/edit/'.$category->id)
            ->andType('Moozmoozmooz', 'name')
            ->andPress('Save Changes')
            ->andSeeInDatabase('categories', ['id' => $category->id, 'name' => 'Moozmoozmooz']);
    }

    /**
     * @test
     */
    public function it_shows_a_single_category()
    {
        $this->loginAsRegisteredUser();

        $category = TestDummy::create('Omashu\Stock\Category');

        $this->visit('admin/categories/'.$category->slug)
            ->andSeePageIs('admin/categories/'.$category->slug)
            ->andSee($category->name)
            ->andSee($category->description);
    }


    protected function loginAsRegisteredUser()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);
    }

}