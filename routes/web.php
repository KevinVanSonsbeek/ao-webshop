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

Route::get('/category/{category}', 'CategoryController@displayCategory');
Route::get('/product/{id}', 'ProductController@getProduct');

Route::get('/orders', 'OrderController@index');
Route::get('/order/{id}', 'OrderController@showOrder');

Route::group(['middleware' => 'web'], function () {
    Route::get('/cart', 'ShoppingCartController@index');
    Route::post('/cart/add', 'ShoppingCartController@addItem');
    Route::post('/cart/remove', 'ShoppingCartController@removeItem');
    Route::post('/cart/quantity', 'ShoppingCartController@setQuantity');
    Route::get('/cart/clear', 'ShoppingCartController@clearCart');
});



Route::post('/order/add', 'OrderController@add');

