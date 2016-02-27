<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 2/20/16
 * Time: 10:42 AM
 */

$factory->define(Omashu\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Omashu\Stock\Brand::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'website' => $faker->domainName,
        'image_path' => 'images/stock/defaultbrand.png',
        'tagline' => $faker->sentences(2, true),
        'zh_tagline' => '這是個很酷的品牌。這有很多很酷的產品。',
        'description' => $faker->paragraphs(2, true),
        'location' => $faker->words(2, true)
    ];
});

$factory->define(\Omashu\Stock\Category::class, function (Faker\Generator $faker, $attributes) {
    $brandId = isset($attributes['brand_id']) ? $attributes['brand_id']: factory(\Omashu\Stock\Brand::class)->create()->id;
    return [
        'brand_id' => $brandId,
        'name' => $faker->words(3, true),
        'zh_name' => '醬汁',
        'description' => $faker->paragraph,
        'image_path' => 'images/stock/defaultcategory.png'
    ];
});

$factory->define(\Omashu\Stock\Product::class, function (Faker\Generator $faker, $attributes) {
    $categoryId = isset($attributes['category_id']) ? $attributes['category_id']: factory(\Omashu\Stock\Category::class)->create()->id;
    return [
        'category_id' => $categoryId,
        'name' => $faker->words(2, true),
        'zh_name' => '大蒜，薑，鹽。',
        'quantifier' => $faker->word,
        'zh_quantifier' => '五十毫升',
        'description' => $faker->paragraphs(2, true),
        'image_path' => 'images/stock/defaultproduct.png',
        'is_available' => false,
        'price' => $faker->numberBetween(50, 500),
        'write_up' => $faker->paragraph()
    ];
});

$factory->define(\Omashu\Stock\Stockist::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'zh_address' => '台中市南區工學一街182號',
        'phone' => $faker->phoneNumber,
        'website' => $faker->domainName,
        'image_path' => 'images/stock/defaultstockist.png'
    ];
});

$factory->define(\Omashu\Orders\Order::class, function (Faker\Generator $faker) {
    return [
        'order_number' => $faker->word . $faker->randomNumber(6),
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'total_price' => $faker->numberBetween(100, 500),
        'customer_query' => $faker->paragraph
    ];
});

$factory->define(\Omashu\Orders\OrderItem::class, function (Faker\Generator $faker, $attributes) {
    $orderId = isset($attributes['order_id']) ? $attributes['order_id']: factory(\Omashu\Orders\Order::class)->create()->id;
    $productId = isset($attributes['product_id']) ? $attributes['product_id']: factory(\Omashu\Stock\Product::class)->create()->id;
    return [
        'order_id' => $orderId,
        'description' => $faker->words(3, true),
        'quantity' => $faker->numberBetween(1,6),
        'unit_price' => $faker->numberBetween(50,200),
        'product_id' => $productId,
    ];
});

$factory->define(\Omashu\Shipping\ShippingRule::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'rate' => 200,
        'free_above' => 1000
    ];
});