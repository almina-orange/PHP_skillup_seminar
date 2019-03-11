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

// Route::get('/user', 'UserController@index');
// Route::get('/sample', 'MyController@index');
// Route::get('/bbs', 'BbsController@index');
// Route::post('/bbs', 'BbsController@create');

// Route::get('github', 'Github\GithubController@top');
// Route::post('github/issue', 'Github\GithubController@createIssue');
// Route::get('login/github', 'Auth\LoginController@redirectToProvider');
// Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

// Route::post('user', 'User\UserController@updateUser');

// Route::get('/', 'HomeController@index');
// Route::post('/upload', 'HomeController@upload');

Route::get('/', 'Main\LoginController@index');
Route::get('/home', 'Main\HomeController@index');
// Route::get('/user', 'Main\UserController@index');
Route::get('/user', 'Main\UserController@viewUser');
Route::get('/post', 'Main\PostController@index');
Route::post('/post/delete', 'Main\PostController@delete');
Route::get('/like/list', 'Main\LikeController@index');
Route::post('/like', 'Main\LikeController@like');
Route::post('/post/upload', 'Main\PostController@upload');

Route::get('/login/github', 'Auth\LoginController@redirectToProvider');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/edit', 'Main\AccountController@index');
Route::post('/edit/update', 'Main\AccountController@updateUser');