<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Laracasts\TestDummy\Factory as TestDummy;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('ProductSeeder');
        $this->call('StockistSeeder');
        $this->call('ShippingRuleSeeder');
    }

}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        factory(\Omashu\User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);
    }
}

class ProductSeeder extends Seeder
{

    public function run()
    {
        $brand = factory(\Omashu\Stock\Brand::class)->create();
        $categories = factory(\Omashu\Stock\Category::class, 3)->create(['brand_id' => $brand->id]);

        $categories->each(function($category) {
            factory(\Omashu\Stock\Product::class, 3)->create(['category_id' => $category->id]);
        });
    }
}

class StockistSeeder extends Seeder
{

    public function run()
    {
        factory(Omashu\Stock\Stockist::class, 3)->create();
    }
}

class ShippingRuleSeeder extends Seeder
{
    public function run()
    {
        factory(\Omashu\Shipping\ShippingRule::class)->create(['name' => 'general']);
    }
}
