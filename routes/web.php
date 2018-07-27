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


Route::get('/profile/{id}', 'ProfileController@profile')->name('users.profile');

