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
    return view('index');
});
Route::get('/post', 'PostController@index');
Route::post('/post', 'PostController@post');
Route::get('/profile', 'UserController@index')->name('profile');
Route::get('/profile/edit', 'UserController@edit');
Route::post('/profile/store', 'UserController@store');
Route::get('/article', function () {
    return view('article');
});
Route::get('/portfolio', function () {
    return view('portfolio');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
