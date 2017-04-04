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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/callback', function () {
    return view('callback');
});

Route::get('/voting', function () {
    return view('voting');
});

Route::get('/wp', function () {
    return view('welcome');
});

Route::get('/store', function () {
    return view('store');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
