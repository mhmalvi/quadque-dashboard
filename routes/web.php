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

    Route::post("tmp-file-upload", "FileUploadController@storeFile");

    /**
     * Product
     */
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', 'ProductsController@index')->name('all');
        Route::get('add-new', 'ProductsController@create')->name('create');
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
        Route::post('/', 'BrandsController@paginatedBrands');
        Route::get('all', 'BrandsController@getBrands');
        Route::post('store', 'BrandsController@store');
        Route::get('{brand}/edit', 'BrandsController@edit');
        Route::put('{brand}/update', 'BrandsController@updated');
        Route::delete('{brand}/remove', 'BrandsController@destroy');
    });

    /**
     * Bulks
     */
    Route::prefix('bulk-items')->name('bulk.')->group(function () {
        Route::get('import', 'BulksController@import')->name('import');
        Route::get('export', 'BulksController@export')->name('export');
    });

    /**
     * Setting
     */
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::view('general', 'settings.general')->name('general');
    });

    /**
     * SEO
     */
    Route::get('seo', 'SeoController@index')->name('seo');
});

require __DIR__ . '/auth.php';
