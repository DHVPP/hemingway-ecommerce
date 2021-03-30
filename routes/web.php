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

Auth::routes(['register' => false]);

/* BLOG PAGES */
Route::get('/blog', 'BlogController@showAllPosts');
Route::get('/blog/post/{id}', 'BlogController@show');

/* STATIC PAGES */
Route::get('/about-us', 'StaticPagesController@about');
Route::get('/contact', 'StaticPagesController@contact');
Route::get('/legal', 'StaticPagesController@legal');
Route::get('/pokloni', 'StaticPagesController@pokloni');
Route::get('/poslovi', 'StaticPagesController@poslovi');
Route::get('/predlozi', 'StaticPagesController@predlozi');
Route::get('/podaci', 'StaticPagesController@podaci');
Route::get('/pomoc', 'StaticPagesController@pomoc');
Route::get('/placanje', 'StaticPagesController@placanje');
Route::get('/prava-potrosaca', 'StaticPagesController@prava');
Route::get('/politika-privatnosti', 'StaticPagesController@politika');
Route::get('/uslovi-koriscenja', 'StaticPagesController@uslovi');
Route::get('/porucivanje', 'StaticPagesController@narucivanje');

/* ECOMMERCE ROUTES */
Route::get('/pokloni-za-muskarce', 'ProductsController@index');
Route::get('/products/special-offer', 'ProductsController@getSpecialOfferProducts');
Route::get('/products/types', 'ProductsController@getProductsByType');
Route::resource('products', 'ProductsController');
Route::post('/add-cart/{id}', 'ProductsController@addCart');
Route::get('/checkout', 'OrderController@checkout');
Route::post('/order', 'OrderController@store');
Route::post('/remove-cart-item/{id}', 'ProductsController@removeFromCart');
Route::post('/contact-form', 'StaticPagesController@contactFormEmail');
Route::get('/search', 'ProductsController@search');
Route::post('/review/{id}', 'ProductsController@reviewProduct');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'AdminController@home');
    Route::get('/orders/{id}', 'OrderController@show');

    Route::prefix('admin')->group(function () {
        Route::post('/order/{id}/status', 'OrderController@setOrderStatus');

        Route::get('/products', 'ProductsController@adminProducts');
        Route::delete('/products/delete/{id}', 'ProductsController@adminDeleteProducts');
        Route::get('/products/update/{id}', 'ProductsController@adminEditProduct');
        Route::post('/products/update/{id}', 'ProductsController@adminUpdateProduct');
        Route::post('/product', 'ProductsController@store');
        Route::post('/products/color', 'ProductsController@storeProductColor');
        Route::get('/products/color/{id}', 'ProductsController@productColor');
        Route::get('/products/{id}/labels', 'AdminController@labels');
        Route::post('/products/{id}/labels', 'AdminController@storeLabels');
        Route::get('/products/{id}/images', 'ProductsController@deleteProductImage');
        Route::post('/products/images/{id}', 'ProductsController@removeImage');
        Route::get('/color', 'ProductsController@colors');
        Route::post('/color', 'ProductsController@storeNewColor');
        Route::get('/posts', 'BlogController@getAllPosts');
        Route::get('/blog/posts', 'BlogController@newPost');
        Route::post('/blog/posts', 'BlogController@insertNewPost');
        Route::get('/blog/posts/{id}', 'BlogController@editPost');
        Route::post('/blog/posts/{id}', 'BlogController@updatePost');
        Route::delete('/blog/posts/{id}', 'BlogController@deletePost');

        Route::get('/reviews', 'ReviewController@getReviews');
        Route::post('/reviews/{id}', 'ReviewController@approveReview');
        Route::post('/reviews/{id}', 'ReviewController@deleteReview');

        Route::get('/announcement', 'AdminController@announcement');
        Route::post('/announcement', 'AdminController@saveAnnouncement');
    });
});

