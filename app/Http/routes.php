<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Front\PagesController@homePage');


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
        Route::delete('registration/delete/{id}', 'RegistrationController@delete');


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

        Route::get('categories/create/{brand_id}', 'CategoriesController@create');
        Route::get('categories/edit/{id}', 'CategoriesController@edit');
        Route::post('categories/edit/{id}', 'CategoriesController@update');
        Route::get('categories/{slug}', 'CategoriesController@show');
        Route::post('categories/{brand_id}', 'CategoriesController@store');

        Route::get('products/create/{category_id}', 'ProductsController@create');
        Route::get('products/edit/{id}', 'ProductsController@edit');
        Route::post('products/edit/{id}', 'ProductsController@update');
        Route::post('products/{category_id}', 'ProductsController@store');
        Route::get('products/{slug}', 'ProductsController@show');
        Route::delete('products/{id}', 'ProductsController@delete');

        Route::get('stockists', 'StockistsController@index');
        Route::post('stockists', 'StockistsController@store');
        Route::get('stockists/create', 'StockistsController@create');
        Route::get('stockists/edit/{id}', 'StockistsController@edit');
        Route::post('stockists/edit/{id}', 'StockistsController@update');
        Route::get('stockists/{slug}', 'StockistsController@show');
        Route::delete('stockists/{id}', 'StockistsController@delete');

        Route::post('ajaxuploads/brands/imageupload', 'AjaxUploadController@storeBrandImage');
        Route::post('ajaxuploads/categories/imageupload', 'AjaxUploadController@storeCategoryImage');
        Route::post('ajaxuploads/products/imageupload', 'AjaxUploadController@storeProductImage');
        Route::post('ajaxuploads/stockists/imageupload', 'AjaxUploadController@storeStockistImage');

    });

});