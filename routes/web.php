<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test');

Route::get('/category/{category}', 'CategoryController@display_category');
Route::get('/product/{id}', 'ProductController@display_product');

Route::get('/cart', 'ShoppingCartController@index');
Route::get('/cart/add/{item_id}', 'ShoppingCartController@add_item');
Route::get('/cart/clear', 'ShoppingCartController@clear_cart');
