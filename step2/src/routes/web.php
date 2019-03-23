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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Main\LoginController@index');
Route::get('/home', 'Main\HomeController@index');
Route::get('/home/rank', 'Main\HomeController@ranking');
Route::get('/user', 'Main\UserController@index');
Route::get('/post', 'Main\PostController@index');
Route::post('/post/delete', 'Main\PostController@delete');
Route::get('/like/list', 'Main\LikeController@index');
Route::get('/favo', 'Main\FavoController@index');
Route::post('/like', 'Main\LikeController@like');
Route::post('/post/upload', 'Main\PostController@upload');
Route::get('/search', 'Main\SearchController@search');

Route::get('/login/github', 'Auth\LoginController@redirectToProvider');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/logout', 'Auth\LoginController@logout');
