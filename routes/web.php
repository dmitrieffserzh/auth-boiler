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

Auth::routes();

// SOCIAL NETWORK AUTH
Route::get ( '/redirect/{service}', 'Auth\OAuthController@redirect' )->name('oauth.login');
Route::get ( '/callback/{service}', 'Auth\OAuthController@callback' );

Route::get('/', 'HomeController@index')->name('home');


//Route::get('/profile/{id}', 'ProfileController@profile')->name('users.profile');



// USERS
Route::group([
	'prefix' => 'users',
	'name'   => 'users' ], function() {
	Route::get('/', 'ProfileController@index')->name('users.index');
	Route::get('/user_id{id}', 'ProfileController@profile')->name('users.profile');
	Route::get('/user_id{id}/settings', 'ProfileController@settings')->name('users.profile.settings');
	Route::post('/user_id{id}/settings', 'ProfileController@settings_store')->name('users.profile.settings_store');
});