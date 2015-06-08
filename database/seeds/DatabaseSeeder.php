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
    }

}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->truncate();

        TestDummy::create('Omashu\User', ['email' => 'joe@example.com']);
    }
}

class ProductSeeder extends Seeder
{

    public function run()
    {
        DB::table('brands')->delete();

        $brands = [];

        foreach (range(1, 3) as $index) {
            $brands[] = TestDummy::create('Omashu\Stock\Brand');
        }

        $categories = [];

        foreach ($brands as $brand) {
            foreach(range(1,3) as $number) {
                $categories[] = TestDummy::create('Omashu\Stock\Category', ['brand_id' => $brand->id]);
            }
        }

        foreach ($categories as $category) {
            foreach(range(1,5) as $count) {
                TestDummy::create('Omashu\Stock\Product', ['category_id' => $category->id]);
            }
        }
    }
}

class StockistSeeder extends Seeder
{

    public function run()
    {
        TestDummy::times(3)->create('Omashu\Stock\Stockist');
    }
}
