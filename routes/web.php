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

Auth::routes();

// Normal customer accesible routes
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

// Admin routes that require authentication
Route::group(['middleware' => 'auth', 'prefix' => '/admin'], function() {
	Route::get('/orders', "Admin\OrderController@index")->name('admin.orders');

	Route::get('/order/{order}', "Admin\OrderController@show")->name('admin.order');

	Route::delete('/order/{order}', "Admin\OrderController@delete")->name('admin.order.delete');

	Route::get('/products', "Admin\ProductController@index")->name('admin.products');

	Route::get('/product/{product}', 'Admin\ProductController@show')->name('admin.product');

	Route::post('/product/{product}', 'Admin\ProductController@update')->name('admin.product.update');

	Route::get('/products/new', 'Admin\ProductController@showCreate')->name('admin.product.create');

	Route::post('/products/new', 'Admin\ProductController@create')->name('admin.product.create');

	Route::delete('/products/{product}', 'Admin\ProductController@delete')->name('admin.product.delete');
});


