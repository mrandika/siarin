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

Route::get('/', 'HomeController@index')->name('home');
Route::resource('channel','ChannelController');

// Account specific routing
Route::get('/account/{account}', 'AccountController@show')->name('account.show');
Route::get('/account/{account}/edit', 'AccountController@edit')->name('account.edit');
Route::match(array('PUT', 'PATCH'), "/account/{account}", array(
    'uses' => 'AccountController@update',
    'as' => 'account.update'
));

Auth::routes();

