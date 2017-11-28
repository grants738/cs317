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

Route::group(['middleware' => 'web'], function() {
	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/products', "HomeController@index")->name('home');

	Route::get('/products/{slug}', "ProductController@get")->name('product.get');

	Route::get('/cart', 'CartController@index')->name('cart.index');

	Route::get('/cart/add/{slug}/{quantity}', "CartController@add")->name('cart.add');

	Route::post('/cart/update/{slug}', "CartController@update")->name('cart.update');

	Route::get('/cart/remove/{slug}', "CartController@remove")->name('cart.remove');

	Route::get('/cart/flush', "CartController@flush");

	Route::get('/order', "OrderController@index")->name('order.index');

	Route::get('/order/{hash}', "OrderController@show")->name('order.show');

	Route::post('/order', "OrderController@create")->name('order.create');

	Route::get('/braintree/token', 'BraintreeController@token')->name('braintree.token');
});


