<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::loginUsingId(1);

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@login']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('blog', 'BlogController@index');
Route::get('blog/latest', 'BlogController@latest');
Route::get('blog/{post_id}', 'BlogController@show')->where('post_id', '[0-9]+');

Route::resource('travel', 'TravelController', array('only' => array('index', 'show')));

Route::resource('posts', 'PostController', array('only' => array('index', 'store', 'show', 'update')));
Route::get('drafts', 'PostController@draftPosts');

Route::get('/core/post-types', ['as' => 'core.post-types', 'uses' => 'CoreController@getPostTypes']);