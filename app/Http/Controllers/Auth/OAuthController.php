<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Models\Profile;
use App\Models\OAuth;
use App\Http\Controllers\Controller;

class OAuthController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| OAuth Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	public function __construct() {
		$this->middleware( 'guest' );
	}


	public function redirect( $service ) {
		return Socialite::driver( $service )->redirect();
	}


	public function callback( $service ) {


		//dd(substr( str_shuffle( str_repeat( $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( 8 / strlen( $x ) ) ) ), 1, 8 ));


		if ( $service == 'vkontakte' ) {

			$request = Socialite::with( $service )
			                    ->scopes( [
				                    'email',
			                    ] )
			                    ->fields( [
				                    'nickname',
				                    'first_name',
				                    'last_name',
				                    'sex',
				                    'bdate',
				                    'city',
				                    'photo_max_orig'
			                    ] )
			                    ->user();

			$data = $this->handleRequestVK( $request );
			//dd( $data );

		} elseif ( $service == 'twitter' ) {


		} elseif ( $service == 'facebook' ) {

			$request = Socialite::with( $service )
			                    ->scopes( [
				                    'email',
				                    'user_gender',
				                    'user_birthday',
				                    'user_location'
			                    ] )
			                    ->fields( [
				                    'id',
				                    'first_name',
				                    'last_name',
				                    'email',
				                    'gender',
				                    'birthday',
				                    'location'
			                    ] )
			                    ->user();

			$data = $this->handleRequestFB( $request );
			//dd( $data );

		} elseif ( $service == 'google' ) {

		}


		//dd($user);


		$authUser = $this->findOrCreateUser( $data, $service );

		Auth::login( $authUser, true );

		return view( 'profile' );
	}


	// REQUEST VKONTAKTE
	public function handleRequestVK( $request ) {

		$data = array(
			'user_id'    => isset( $request->user['id'] ) ? $request->user['id'] : null,
			'email'      => isset( $request->accessTokenResponseBody['email'] ) ? $request->accessTokenResponseBody['email'] : null,
			'nickname'   => isset( $request->user['nickname'] ) ? $request->user['first_name'] : null,
			'first_name' => isset( $request->user['first_name'] ) ? $request->user['first_name'] : null,
			'last_name'  => isset( $request->user['last_name'] ) ? $request->user['last_name'] : null,
			'gender'     => isset( $request->user['sex'] ) ? $request->user['sex'] : null,
			'birthday'   => isset( $request->user['bdate'] ) ? $request->user['bdate'] : null,
			'location'   => isset( $request->user['city']['title'] ) ? $request->user['city']['title'] : null,
			'avatar'     => isset( $request->user['photo_max_orig'] ) ? str_replace( '?ava=1', '', $request->user['photo_max_orig'] ) : null,
		);

		return $data;
	}

	// REQUEST FACEBOOK
	public function handleRequestFB( $request ) {

		$data = array(
			'user_id'    => isset( $request->user['id'] ) ? $request->user['id'] : null,
			'email'      => isset( $request->user['email'] ) ? $request->user['email'] : null,
			'nickname'   => isset( $request->user['nickname'] ) ? $request->user['nickname'] : null,
			'first_name' => isset( $request->user['first_name'] ) ? $request->user['first_name'] : null,
			'last_name'  => isset( $request->user['last_name'] ) ? $request->user['last_name'] : null,
			'gender'     => isset( $request->user['gender'] ) ? $request->user['gender'] : null,
			'birthday'   => isset( $request->user['birthday'] ) ? str_replace( '/', '.', $request->user['birthday'] ) : null,
			'location'   => isset( $request->user['location']['name'] ) ? $request->user['location']['name'] : null,
			'avatar'     => isset( $request->avatar ) ? str_replace( '?type=normal', '?width=1920', $request->avatar ) : null,
		);

		return $data;
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function findOrCreateUser( $data, $service ) {

		$authUser = OAuth::where( 'provider', $service )
		                 ->where( 'provider_id', $data['user_id'] )
		                 ->first();
		//dd($authUser);

		if ( $authUser ) {
			return $authUser->user;
		}


		$pass = substr( str_shuffle( str_repeat( $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( 6 / strlen( $x ) ) ) ), 1, 6 );

		// Create user
		$user = User::create( [
			'nickname'                => isset($data['nickname']) ? mb_strtolower($data['nickname']) : substr( str_shuffle( str_repeat( $x = '0123456789', ceil( 15 / strlen( $x ) ) ) ), 1, 15 ),
			'email'                   => mb_strtolower( $data['email'] ),
			'password'                => bcrypt( $pass ),
			'registration_ip'         => request()->ip(),
			'registration_user_agent' => request()->header( 'User-Agent' ),
		] );


		$user_oauth              = new OAuth();
		$user_oauth->provider    = $service;
		$user_oauth->provider_id = $data['user_id'];
		//$user_oauth->token       = $user->token;

		$user->oAuth()->save( $user_oauth );

		// CREATE USER PROFILE

		if ( isset($data['avatar'] )) {

			$filename = "uploads/avatars/" . time() . ".jpg";
			// The filename to save in the database.
			file_put_contents(
				$filename,
				file_get_contents( $data['avatar'] )
			);
		}


		$profile             = new Profile();
		$profile->first_name = $data['first_name'];
		$profile->last_name  = $data['last_name'];
		$profile->gender     = $data['gender'];
		$profile->birthday   = $data['birthday'];
		$profile->location   = $data['location'];
		$profile->avatar     = $filename;

		$user->profile()->save( $profile );

		//dd($pass);
		return $user;

	}

}