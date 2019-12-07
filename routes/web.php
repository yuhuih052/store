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
Route::get('/', 'PagesController@root')->name('root');

Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/email_verified/send','EmailVerificationController@send')->name('email_verified.send');
    Route::get('/email_verify_page','PagesController@emailVerifiedNotice')->name('email_verify_page');
    Route::get('/email_verified/verify','EmailVerificationController@verify')->name('email_verified.verify');
    /*已经通过邮箱验证*/
    Route::middleware(['auth','email_verified'])->group(function(){
        Route::get('user_addresses','UserAddressController@index')->name('user_addresses.index');
    });

});