<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::view('/', 'index')->name('dashboard');

    Route::post("tmp-file-upload", "FilesUploadController@storeFile");
    Route::delete('remove-tmp-file/{folder}', "FilesUploadController@remove");

    /**
     * Product
     */
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', 'ProductsController@index')->name('all');
        Route::get('get', 'ProductsController@getProducts');
        Route::get('add-new', 'ProductsController@create')->name('create');
        Route::post('store', 'ProductsController@store');
        Route::get('{product:slug}/edit', 'ProductsController@edit')->name('edit');
        Route::put('{product:slug}/update', 'ProductsController@update');
        Route::delete('{product:slug}/delete', 'ProductsController@delete');
    });

    /**
     * Category
     */
    Route::prefix('categories')->name('category.')->group(function () {
        Route::get('/', 'CategoriesController@index')->name('all');
        Route::get('all', 'CategoriesController@getAllCategories');
        Route::post('all', 'CategoriesController@paginatedCategories');
        Route::post('store', 'CategoriesController@store');
        Route::get('{category}/edit', 'CategoriesController@edit');
        Route::put('{category}/update', 'CategoriesController@update');
        Route::delete('{category}/remove', 'CategoriesController@destroy');
    });

    /**
     * Brand
     */
    Route::prefix('brands')->name('brand.')->group(function () {
        Route::get('/', 'BrandsController@index')->name('all');
        Route::get('all', 'BrandsController@getAllBrands');
        Route::post('/', 'BrandsController@paginatedBrands');
        Route::post('store', 'BrandsController@store');
        Route::get('{brand}/edit', 'BrandsController@edit');
        Route::put('{brand}/update', 'BrandsController@update');
        Route::delete('{brand}/remove', 'BrandsController@destroy');
    });

    /**
     * Attributes
     */
    Route::prefix('attributes')->name('attribute.')->group(function()
    {
        Route::get('/', 'AttributesController@index')->name('all');
        Route::get('add-new', 'AttributesController@create')->name('create');
        Route::get('get', 'AttributesController@getAttributes');
        Route::post('store', 'AttributesController@store');
        Route::delete("{attribute}/delete", 'AttributesController@destroy');

        Route::prefix('children')->name('child.')->group(function()
        {
            Route::get('{attribute}/all', 'ChildAttributeController@all');
            Route::post('/add-new', 'ChildAttributeController@store');
            Route::delete('{attribute}/{child_attribute}/delete',
                'ChildAttributeController@destroy');
        });
    });


    /**
     * Unit Types
     */
    Route::prefix('unit-types')->group(function () {
        Route::get('all', 'UnitTypesController@getUnitTypes');
    });

    /**
     * Bulks
     */
    Route::prefix('bulk-items')->name('bulk.')->group(function () {
        Route::get('import', 'BulksController@import')->name('import');
        Route::get('export', 'BulksController@export')->name('export');
    });

    // Orders
    Route::prefix('orders')->name('order.')->group(function()
    {
        Route::get('/', 'OrdersController@index')->name('index');
        Route::get('get', 'OrdersController@getAll');
        Route::get('view/{order:order_no}', 'OrdersController@view')->name('view');

        Route::post('update/{order:order_no}/order_status', 'OrdersController@updateOrderStatus');
    });

    /**
     * Setting
     */
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::view('general', 'settings.general')->name('general');
    });

    Route::prefix('site-customization')->name('site_customization.')->group(function()
    {
        Route::get('logo', 'SiteCustomization/LogoController@index')->name('logo.index');
    });

    /**
     * SEO
     */
    Route::get('seo', 'SeoController@index')->name('seo');
});

require __DIR__ . '/auth.php';
