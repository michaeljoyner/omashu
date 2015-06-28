<?php


$factory('Omashu\Stock\Brand', [
    'name' => $faker->company,
    'website' => $faker->domainName,
    'image_path' => 'images/stock/defaultbrand.png',
    'tagline' => $faker->sentences(2),
    'zh_tagline' => '這是個很酷的品牌。這有很多很酷的產品。',
    'description' => $faker->paragraphs(2),
    'location' => $faker->words(2)
]);

$factory('Omashu\Stock\Category', [
    'brand_id' => 'factory:Omashu\Stock\Brand',
    'name' => $faker->words(3),
    'zh_name' => '醬汁',
    'description' => $faker->paragraph,
    'image_path' => 'images/stock/defaultcategory.png'
]);

$factory('Omashu\Stock\Product', [
    'category_id' => 'factory:Omashu\Stock\Category',
    'name' => $faker->words(2),
    'zh_name' => '大蒜，薑，鹽。',
    'quantifier' => $faker->word,
    'zh_quantifier' => '五十毫升',
    'description' => $faker->paragraphs(2),
    'image_path' => 'images/stock/defaultproduct.png',
    'is_available' => true
]);

$factory('Omashu\Stock\Stockist', [
    'name' => $faker->company,
    'address' => $faker->address,
    'zh_address' => '台中市南區工學一街182號',
    'phone' => $faker->phoneNumber,
    'website' => $faker->domainName,
    'image_path' => 'images/stock/defaultstockist.png'
]);

$factory('Omashu\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'password' => 'password'
]);