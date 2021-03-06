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

// Channel specific routing
Route::match(array('PUT', 'PATCH'), "/subscribe/{id}", array(
    'uses' => 'SubscriberController@subscribe',
    'as' => 'channel.subscribe'
));
Route::match(array('PUT', 'PATCH'), "/unsubscribe/{id}", array(
    'uses' => 'SubscriberController@unsubscribe',
    'as' => 'channel.unsubscribe'
));

// Video specific routing
Route::get('/channel/{id}/upload', 'VideoController@index')->name('upload.index');
Route::post('/video/upload', 'VideoController@upload')->name('upload.store');

Auth::routes();

