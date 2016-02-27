<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/6/15
 * Time: 3:28 PM
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laracasts\TestDummy\Factory as TestDummy;
use Omashu\Stock\Brand;

class BrandsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_shows_all_the_brands()
    {
        $this->asLoggedInUser();

        $brands = factory(Brand::class, 3)->create();

        $this->visit('admin/brands');

        $brands->each(function ($brand) {
            $this->see($brand->name);
        });

    }

    /**
     * @test
     */
    public function it_can_add_new_brands()
    {
        $this->asLoggedInUser();

        $this->visit('admin/brands/create')
            ->submitForm('Add Brand', [
                'name' => 'Cola',
                'tagline' => 'Life is good',
                'zh_tagline' => 'Life is good',
                'description' => 'Liquid stuff',
                'website' => 'cola.com',
                'location' => 'Murica'
            ])->seeInDatabase('brands', [
                'name' => 'Cola',
                'tagline' => 'Life is good',
                'zh_tagline' => 'Life is good',
                'description' => 'Liquid stuff',
                'website' => 'http://cola.com',
                'location' => 'Murica'
            ]);
    }

    /**
     * @test
     */
    public function it_edits_an_existing_brand()
    {
        $this->asLoggedInUser();

        $brand = factory(Brand::class)->create();

        $this->visit('admin/brands/edit/' . $brand->id)
            ->type('Mooz is super cool', 'tagline')
            ->press('Save Changes')
            ->seeInDatabase('brands', ['id' => $brand->id, 'tagline' => 'Mooz is super cool']);
    }

    /**
     * @test
     */
    public function it_shows_a_single_brand()
    {
        $this->asLoggedInUser();

        $brand = factory(Brand::class)->create();

        $this->visit('admin/brands/' . $brand->slug)
            ->see($brand->name)
            ->see($brand->description)
            ->seePageIs('admin/brands/' . $brand->slug);
    }

    /**
     *@test
     */
    public function a_brand_can_be_deleted()
    {
        $brand = factory(Brand::class)->create();

        $this->withoutMiddleware();

        $response = $this->call('DELETE', '/admin/brands/'.$brand->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('brands', ['id' => $brand->id]);
    }

}