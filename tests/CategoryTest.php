<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/7/15
 * Time: 10:46 AM
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laracasts\TestDummy\Factory as TestDummy;
use Omashu\Stock\Brand;
use Omashu\Stock\Category;

class CategoryTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_adds_a_new_category_to_a_brand()
    {
        $this->asLoggedInUser();

        $brand = factory(Brand::class)->create();

        $this->visit('admin/brands/' . $brand->id . '/categories/create/')
            ->submitForm('Add Category', [
                'name'        => 'Shoes',
                'zh_name'     => 'Zhoes',
                'description' => 'fairly obvious'
            ])->seeInDatabase('categories', [
                'brand_id'    => $brand->id,
                'name'        => 'Shoes',
                'zh_name'     => 'Zhoes',
                'description' => 'fairly obvious'
            ]);
    }

    /**
     * @test
     */
    public function it_shows_all_categories_for_a_brand()
    {
        $this->asLoggedInUser();

        $brand = factory(Brand::class)->create();
        $categories = factory(Category::class, 3)->create(['brand_id' => $brand->id]);

        $this->visit('admin/brands/' . $brand->slug)
            ->seePageIs('admin/brands/' . $brand->slug);

        $categories->each(function($category) {
            $this->see($category->name);
        });
    }

    /**
     * @test
     */
    public function it_edits_an_existing_category()
    {
        $this->asLoggedInUser();

        $category = factory(Category::class)->create();

        $this->visit('admin/categories/edit/' . $category->id)
            ->type('Moozmoozmooz', 'name')
            ->press('Save Changes')
            ->seeInDatabase('categories', ['id' => $category->id, 'name' => 'Moozmoozmooz']);
    }

    /**
     * @test
     */
    public function it_shows_a_single_category()
    {
        $this->asLoggedInUser();

        $category = factory(Category::class)->create();

        $this->visit('admin/categories/' . $category->slug)
            ->seePageIs('admin/categories/' . $category->slug)
            ->see($category->name)
            ->see($category->description);
    }

    /**
     *@test
     */
    public function a_category_can_be_deleted()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $category = factory(Category::class)->create();

        $response = $this->call('DELETE', '/admin/categories/'.$category->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('categories', ['id' => $category->id]);
    }

}