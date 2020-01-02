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


Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');
Route::get('products/edible', 'ProductsController@edible')->name('products.edible');
Route::get('products/daily_use', 'ProductsController@daily_use')->name('products.daily_use');
Route::get('products/wash_rinse', 'ProductsController@wash_rinse')->name('products.wash_rinse');
Route::post('cart', 'CartController@addToCart')->name('cart.addToCart');

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/email_verified/send','EmailVerificationController@send')->name('email_verified.send');
    Route::get('/email_verify_page','PagesController@emailVerifiedNotice')->name('email_verify_page');
    Route::get('/email_verified/verify','EmailVerificationController@verify')->name('email_verified.verify');
    /*已经通过邮箱验证*/
    Route::middleware(['auth','email_verified'])->group(function(){
        Route::get('user_addresses','UserAddressController@index')->name('user_addresses.index');
        Route::get('user_addresses/create','UserAddressController@create')->name('user_addresses.create');
        Route::post('user_addresses/store','UserAddressController@store')->name('user_addresses.store');
        Route::get('user_addresses/{user_address}', 'UserAddressController@edit')->name('user_addresses.edit');
        Route::put('user_addresses/{user_address}', 'UserAddressController@update')->name('user_addresses.update');
        Route::delete('user_addresses/{user_address}', 'UserAddressController@delete')->name('user_addresses.delete');
        Route::post('products/{product}/favorite','ProductsController@favor')->name('products.favor');
        Route::delete('products/{product}/favorite','ProductsController@disfavor')->name('products.disfavor');
        Route::get('products/favorites','ProductsController@favorites')->name('products.favorites');

        Route::get('cart/show','CartController@show')->name('cart.show');
        Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');
        Route::post('orders', 'OrdersController@store')->name('orders.store');
        Route::get('orders', 'OrdersController@index')->name('orders.index');
        Route::get('orders/{order}','OrdersController@details')->name('orders.details');
    });

});

Route::get('products/{product}', 'ProductsController@details')->name('products.details');