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

Route::get('/', 'HomeController@show');

Auth::routes();

/* Static pages */
Route::get('/about-us', 'StaticPagesController@about');
Route::get('/contact', 'StaticPagesController@contact');
Route::get('/legal', 'StaticPagesController@legal');

Route::get('/products/types', 'ProductsController@getProductsByType');
Route::resource('products', 'ProductsController');
Route::post('/add-cart/{id}', 'ProductsController@addCart');
Route::get('/checkout', 'OrderController@checkout');
Route::post('/order', 'OrderController@store');
Route::post('/remove-cart-item/{id}', 'ProductsController@removeFromCart');
Route::post('/contact-form', 'StaticPagesController@contactFormEmail');

Route::get('/home', 'AdminController@home')->middleware('auth');
Route::get('/orders/{id}', 'OrderController@show')->middleware('auth');

Route::get('/admin/products', 'ProductsController@adminProducts')->middleware('auth');
Route::post('/admin/product', 'ProductsController@store')->middleware('auth');
Route::post('/admin/products/color', 'ProductsController@storeProductColor')->middleware('auth');
Route::get('/admin/products/color/{id}', 'ProductsController@productColor')->middleware('auth');
Route::get('/admin/color', 'ProductsController@colors')->middleware('auth');
Route::post('/admin/color', 'ProductsController@storeNewColor')->middleware('auth');

Route::get('/search', 'ProductsController@search');
