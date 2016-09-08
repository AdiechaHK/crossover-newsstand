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

// Main index route
Route::get('/', 'NewsController@index');

// Default authentication routes
Auth::routes();

// Additional Authentication Routes
Route::get('/register_request', 'Auth\RegisterController@register_request_view');
Route::post('/register_request', 'Auth\RegisterController@register_request');
Route::get('/register/{hash}', 'Auth\RegisterController@register_view');
Route::get('/auth/resend', 'Auth\RegisterController@register_request');

// News resource and related routes
Route::resource('/news', 'NewsController');
Route::get('/my_news', 'NewsController@user_news');
Route::post('/publish/news/{id}', 'NewsController@toggle_publish');

// Route for export pdf of particular news
Route::get('/export/news/{id}', 'NewsController@export_pdf');

// Api routes
Route::get('/rss/news', 'NewsController@feeds');
Route::get('/load/news/{page?}', 'NewsController@load_more');
