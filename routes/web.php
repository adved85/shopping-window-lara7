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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'ProductController@topSellers');
Route::resource('products', 'ProductController')->only(['index', 'show']);

Route::get('cart', 'CartController@index');
Route::get('add-to-cart/{id}', 'CartController@addToCart');
Route::patch('update-cart', 'CartController@updateCart');
Route::delete('remove-from-cart', 'CartController@removeFromCart');

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', 'CheckoutController@create')->name('create');
        Route::post('store', 'CheckoutController@store')->name('store');
    });

    Route::resource('orders', 'OrderController')->only(['index', 'show']);
});
