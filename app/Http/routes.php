<?php


Route::get('/', 'Front\PagesController@homePage');
Route::get('brands', 'Front\PagesController@brandsPage');
Route::get('products', 'Front\PagesController@productsPage');
Route::get('product/{slug}', 'Front\PagesController@product');
Route::get('stockists', 'Front\PagesController@stockistsPage');
Route::get('cart', 'Front\PagesController@cart');

Route::get('checkout', 'CheckoutController@checkout');
Route::post('checkout', 'CheckoutController@placeOrder');

Route::get('thanks', 'CheckoutController@thanks');

Route::post('contactomashu', 'ContactsController@getMessage');

Route::get('api/cart', 'CartController@index');
Route::get('api/cart/totals', 'CartController@totals');
Route::post('api/cart', 'CartController@addProduct');
Route::put('api/cart/{rowid}', 'CartController@updateRow');
Route::delete('api/cart/{rowid}', 'CartController@removeRow');
Route::get('api/cart/summary', 'CartController@summary');

/*
 * Admin Routes
 */

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', 'AuthController@showLogin');
        Route::post('login', 'AuthController@doLogin');
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'PagesController@dashboard');

        Route::get('register', 'RegistrationController@showRegister');
        Route::post('register', 'RegistrationController@register');
        Route::delete('users/{id}', 'RegistrationController@delete');


        Route::get('logout', 'AuthController@logout');
        Route::get('resetpassword', 'AuthController@showPasswordReset');
        Route::post('resetpassword', 'AuthController@resetPassword');

        Route::get('brands', 'BrandsController@index');
        Route::get('brands/create', 'BrandsController@create');
        Route::post('brands', 'BrandsController@store');
        Route::get('brands/edit/{id}', 'BrandsController@edit');
        Route::post('brands/edit/{id}', 'BrandsController@update');
        Route::get('brands/{slug}', 'BrandsController@show');
        Route::delete('brands/{id}', 'BrandsController@delete');
        Route::post('api/uploads/brands/{brandId}/image', 'BrandsController@setCoverPic');

        Route::get('brands/{brandId}/categories/create', 'CategoriesController@create');
        Route::get('categories/edit/{id}', 'CategoriesController@edit');
        Route::post('categories/edit/{id}', 'CategoriesController@update');
        Route::get('categories/{slug}', 'CategoriesController@show');
        Route::post('brands/{brandId}/categories', 'CategoriesController@store');
        Route::delete('categories/{id}', 'CategoriesController@delete');
        Route::post('api/uploads/categories/{categoryId}/image', 'CategoriesController@setCoverPic');

        Route::get('categories/{category_id}/products/create', 'ProductsController@create');
        Route::get('products/edit/{id}', 'ProductsController@edit');
        Route::post('products/edit/{id}', 'ProductsController@update');
        Route::post('categories/{category_id}/products', 'ProductsController@store');
        Route::get('products/{slug}', 'ProductsController@show');
        Route::delete('products/{id}', 'ProductsController@delete');

        Route::get('stockists', 'StockistsController@index');
        Route::post('stockists', 'StockistsController@store');
        Route::get('stockists/create', 'StockistsController@create');
        Route::get('stockists/edit/{id}', 'StockistsController@edit');
        Route::post('stockists/edit/{id}', 'StockistsController@update');
        Route::get('stockists/{slug}', 'StockistsController@show');
        Route::delete('stockists/{id}', 'StockistsController@delete');
        Route::post('api/uploads/stockists/{stockistId}/image', 'StockistsController@setCoverPic');

        Route::post('api/uploads/products/{productId}/image', 'ProductsController@setCoverPic');
        Route::post('api/products/{productId}/availability', 'ProductsController@setAvailability');

        Route::post('ajaxuploads/brands/imageupload', 'AjaxUploadController@storeBrandImage');
        Route::post('ajaxuploads/categories/imageupload', 'AjaxUploadController@storeCategoryImage');
        Route::post('ajaxuploads/products/imageupload', 'AjaxUploadController@storeProductImage');
        Route::post('ajaxuploads/stockists/imageupload', 'AjaxUploadController@storeStockistImage');

        Route::get('shippingrules', 'ShippingRulesController@index');
        Route::get('shippingrules/{id}/edit', 'ShippingRulesController@edit');
        Route::post('shippingrules/{id}', 'ShippingRulesController@update');

        Route::get('orders', 'OrdersController@index');
        Route::get('orders/archived', 'OrdersController@archived');
        Route::get('orders/filter/{status}', 'OrdersController@filterByStatus');
        Route::get('orders/{id}', 'OrdersController@show');
        Route::delete('orders/{id}', 'OrdersController@archive');


        Route::post('/api/orders/{id}/cancel', 'OrdersController@cancelledStatus');
        Route::post('/api/orders/{id}/pay', 'OrdersController@paidStatus');
        Route::post('/api/orders/{id}/ship', 'OrdersController@shippedStatus');

    });

});