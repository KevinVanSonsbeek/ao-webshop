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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/category/{category}', 'CategoryController@display_category');
Route::get('/product/{id}', 'ProductController@get_product');

Route::get('/orders', 'OrderController@index');

Route::get('/cart', 'ShoppingCartController@index');
Route::post('/cart/add', 'ShoppingCartController@add_item');
Route::post('/cart/remove', 'ShoppingCartController@remove_item');
Route::post('/cart/quantity', 'ShoppingCartController@set_quantity');
Route::get('/cart/clear', 'ShoppingCartController@clear_cart');
