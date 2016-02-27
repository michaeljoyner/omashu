<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/7/15
 * Time: 6:28 PM
 */

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Omashu\Stock\Category;
use Omashu\Stock\Product;

class ProductsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_shows_all_products_for_a_category()
    {
        $this->asLoggedInUser();
        $category = factory(Category::class)->create();
        $products = factory(Product::class, 3)->create(['category_id' => $category->id]);

        $this->visit('admin/categories/' . $category->slug)
            ->seePageIs('admin/categories/' . $category->slug);

        $products->each(function ($product) {
            $this->see($product->name);
        });
    }

    /**
     * @test
     */
    public function it_adds_a_new_product_to_a_category()
    {
        $this->asLoggedInUser();

        $category = factory(Category::class)->create();

        $this->visit('admin/categories/' . $category->id . '/products/create')
            ->submitForm('Add Product', [
                'name' => 'Whizzee',
                'zh_name' => '大蒜，薑，鹽。',
                'quantifier' => 'unit',
                'zh_quantifier' => '五十毫升',
                'description' => 'super cool toy',
                'price' => '300',
                'write_up' => 'better than anything else'
            ])
            ->seeInDatabase('products', [
                'name' => 'Whizzee',
                'zh_name' => '大蒜，薑，鹽。',
                'quantifier' => 'unit',
                'zh_quantifier' => '五十毫升',
                'description' => 'super cool toy',
                'price' => '30000',
                'write_up' => 'better than anything else'
            ]);
    }

    /**
     * @test
     */
    public function it_shows_a_single_product()
    {
        $this->asLoggedInUser();

        $product = factory(Product::class)->create();

        $this->visit('admin/products/' . $product->slug)
            ->seePageIs('admin/products/' . $product->slug)
            ->see($product->name)
            ->see($product->quantifier)
            ->see($product->description);
    }

    /**
     * @test
     */
    public function it_edits_an_existing_product()
    {
        $this->asLoggedInUser();

        $product = factory(Product::class)->create();

        $this->visit('admin/products/edit/' . $product->id)
            ->type('Mooz is Awesome', 'name')
            ->type('12 inches', 'quantifier')
            ->press('Save Changes')
            ->seeInDatabase('products', [
                'id'         => $product->id,
                'name'       => 'Mooz is Awesome',
                'quantifier' => '12 inches'
            ]);
    }

    /**
     *@test
     */
    public function a_product_can_be_deleted()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $product = factory(Product::class)->create();

        $response = $this->call('DELETE', '/admin/products/'.$product->id);
        $this->assertEquals(302, $response->status());

        $this->notSeeInDatabase('products', ['id' => $product->id, 'deleted_at' => null]);
    }

    /**
     *@test
     */
    public function a_product_can_be_marked_as_available_via_api_endpoint()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $product = factory(Product::class)->create();
        $this->assertFalse($product->is_available);

        $response = $this->call('POST', '/admin/api/products/'.$product->id.'/availability', [
            'available' => true,
        ]);
        $this->assertEquals(200, $response->status());
        $this->assertContains('"new_state":true', $response->getContent());

        $product = Product::findOrFail($product->id);
        $this->assertEquals(1, $product->is_available);
    }

    /**
     *@test
     */
    public function a_product_can_be_marked_as_unavailable_via_api_endpoint()
    {
        $this->asLoggedInUser();
        $this->withoutMiddleware();

        $product = factory(Product::class)->create();
        $product->setAvailability(true);
        $this->assertEquals(1, $product->is_available);

        $response = $this->call('POST', '/admin/api/products/'.$product->id.'/availability', [
            'available' => false,
        ]);
        $this->assertEquals(200, $response->status());
        $this->assertContains('"new_state":false', $response->getContent());

        $product = Product::findOrFail($product->id);
        $this->assertEquals(0, $product->is_available);
    }
}