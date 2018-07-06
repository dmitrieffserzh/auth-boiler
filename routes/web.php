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

Route::get ( '/redirect/{service}', 'Auth\LoginController@redirect' )->name('auth.login.social');
Route::get ( '/callback/{service}', 'Auth\LoginController@callback' )->name('auth.callback.social');

Route::get('/', 'HomeController@index')->name('home');
