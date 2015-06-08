<?php


$factory('Omashu\Stock\Brand', [
    'name' => $faker->company,
    'website' => $faker->domainName,
    'image_path' => 'images/stock/defaultbrand.png',
    'tagline' => $faker->sentences(2),
    'description' => $faker->paragraphs(2)
]);

$factory('Omashu\Stock\Category', [
    'brand_id' => 'factory:Omashu\Stock\Brand',
    'name' => $faker->words(3),
    'description' => $faker->paragraph,
    'image_path' => 'images/stock/defaultcategory.png'
]);

$factory('Omashu\Stock\Product', [
    'category_id' => 'factory:Omashu\Stock\Category',
    'name' => $faker->words(2),
    'quantifier' => $faker->word,
    'description' => $faker->paragraphs(2),
    'image_path' => 'images/stock/defaultproduct.png',
    'is_available' => true
]);

$factory('Omashu\Stock\Stockist', [
    'name' => $faker->company,
    'address' => $faker->address,
    'phone' => $faker->phoneNumber,
    'website' => $faker->domainName,
    'image_path' => 'images/stock/defaultstockist.png'
]);

$factory('Omashu\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'password' => 'password'
]);