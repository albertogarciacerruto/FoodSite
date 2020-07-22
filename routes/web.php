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

Route::get('/', function () {
    $categories = \DB::table('categories')->get();
    $menu = \DB::table('products')->get();
    return view('welcome', compact('menu', 'categories'));
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'LandController@products')->name('home');

    Route::get('/categories', 'LandController@categories');
    Route::get('/register_category', 'LandController@category');
    Route::post('/register_category', 'LandController@register_category');
    Route::get('/category_delete/{id}', 'LandController@destroy_category');

    Route::get('/allergens', 'LandController@allergens');
    Route::get('/register_allergen', 'LandController@allergen');
    Route::post('/register_allergen', 'LandController@register_allergen');
    Route::get('/allergen_delete/{id}', 'LandController@destroy_allergen');

    Route::get('/products', 'LandController@products');
    Route::get('/register_product', 'LandController@product');
    Route::post('/register_product', 'LandController@register_product');
    Route::get('/product_delete/{id}', 'LandController@destroy_product');
    Route::get('/product_status/{id}', 'LandController@status_product');
});