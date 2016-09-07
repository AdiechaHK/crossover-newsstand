<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'NewsController@index');

Auth::routes();

// Additional Authentication Routes
Route::get('/register_request', 'Auth\RegisterController@register_request_view');
Route::post('/register_request', 'Auth\RegisterController@register_request');
Route::get('/register/{hash}', 'Auth\RegisterController@register_view');

Route::get('/my_news', 'NewsController@user_news');
Route::resource('/news', 'NewsController');
Route::get('/home', 'HomeController@index');
