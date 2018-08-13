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


Route::pattern(	'id',       '[0-9]+');
Route::pattern(	'slug',     '[a-z0-9-_\/]+');
Route::pattern(	'category', '[a-z0-9-_]+');

Route::get( '/',                                [ 'as' => 'home',                         'uses' => 'HomeController@index' ]);

Auth::routes();

// SOCIAL NETWORK AUTH
Route::get( '/redirect/{service}',              [ 'as' => 'oauth.login',                  'uses' => 'Auth\OAuthController@redirect' ]);
Route::get( '/callback/{service}',              [                                         'uses' => 'Auth\OAuthController@callback' ]);


// USERS
Route::group([
	'prefix' => 'users',
	'name'   => 'users' ],
	function() {
		Route::get( '/',                        [ 'as' => 'users.index',                  'uses' => 'ProfileController@index' ]);
		Route::get( '/user_id{id}',             [ 'as' => 'users.profile',                'uses' => 'ProfileController@profile' ]);
		Route::get( '/user_id{id}/settings',    [ 'as' => 'users.profile.settings',       'uses' => 'ProfileController@settings' ]);
		Route::post('/user_id{id}/settings',    [ 'as' => 'users.profile.settings_store', 'uses' => 'ProfileController@settings_store' ]);
	});


// NEWS
Route::group([
	'prefix'        => 'news'],
	//'middleware'    => 'filter.view.counts'],
	function() {
		Route::get('/',                         [ 'as' => 'news.index',                   'uses' => 'NewsController@index' ]);
		Route::get('{category}',                [ 'as' => 'news.category',                'uses' => 'NewsController@category' ]);
		Route::get('{category}/{slug}',         [ 'as' => 'news.show',                    'uses' => 'NewsController@show' ]);
	});

// SERVICE
Route::get( '/feed.rss',                        [ 'as' => 'service.rss',                  'uses' => 'ServiceController@rssTurbo' ]);
Route::get( '/sitemap.xml',                     [ 'as' => 'service.sitemap',              'uses' => 'ServiceController@sitemap' ]);

// PAGES
Route::get( '/{slug}',                          [ 'as' => 'page',                         'uses' => 'PageController@getPage' ]);


