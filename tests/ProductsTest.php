<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 6/7/15
 * Time: 6:28 PM
 */

use Laracasts\TestDummy\Factory as TestDummy;

class ProductsTest extends TestCase
{

    /**
     * @test
     */
    public function it_shows_all_products_for_a_category()
    {
        $this->loginAsRegisteredUser();
        $products = [];
        $category = TestDummy::create('Omashu\Stock\Category');

        foreach (range(1, 5) as $index) {
            $products[] = TestDummy::create('Omashu\Stock\Product', ['category_id' => $category->id]);
        }

        $this->visit('admin/categories/' . $category->slug)
            ->andSeePageIs('admin/categories/' . $category->slug);

        foreach ($products as $product) {
            $this->see($product->name)
                ->andSee($product->quantifier);
        }
    }

    /**
     * @test
     */
    public function it_adds_a_new_product_to_a_category()
    {
        $this->loginAsRegisteredUser();

        $category = TestDummy::create('Omashu\Stock\Category');
        $productInfo = TestDummy::attributesFor('Omashu\Stock\Product');
        unset($productInfo['category_id']);
        unset($productInfo['image_path']);

        $this->visit('admin/products/create/' . $category->id)
            ->andSubmitForm('Add Product', $productInfo)
            ->andSeeInDatabase('products', [
                'name'        => $productInfo['name'],
                'quantifier'  => $productInfo['quantifier'],
                'description' => $productInfo['description']
            ]);

    }

    /**
     * @test
     */
    public function it_shows_a_single_product()
    {
        $this->loginAsRegisteredUser();

        $product = TestDummy::create('Omashu\Stock\Product');

        $this->visit('admin/products/'.$product->slug)
            ->andSeePageIs('admin/products/'.$product->slug)
            ->andSee($product->name)
            ->andSee($product->quantifier)
            ->andSee($product->description);
    }

    /**
     * @test
     */
    public function it_edits_an_existing_product()
    {
        $this->loginAsRegisteredUser();

        $product = TestDummy::create('Omashu\Stock\Product');

        $this->visit('admin/products/edit/'.$product->id)
            ->andType('Mooz is Awesome' ,'name')
            ->andType('12 inches', 'quantifier')
            ->andPress('Save Changes')
            ->andSeeInDatabase('products', [
                'id' => $product->id,
                'name' => 'Mooz is Awesome',
                'quantifier' => '12 inches'
            ]);
    }

    protected function loginAsRegisteredUser()
    {
        $user = TestDummy::create('Omashu\User');
        $this->app['auth']->login($user);
    }

}