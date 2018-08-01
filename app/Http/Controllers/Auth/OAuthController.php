<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Models\Profile;
use App\Models\OAuth;
use App\Http\Controllers\Controller;
use App\Extension\SocialProviderExtension\SocialProvider;

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

		$provider = new SocialProvider();

		$data = $provider->mappingRequest($service);

		$authUser = $this->findOrCreateUser( $data, $service );

		Auth::login( $authUser, true );

		return view( 'profile' );
	}


	public function findOrCreateUser( $data, $service ) {

		$authUser = OAuth::where( 'provider', $service )
		                 ->where( 'provider_id', $data['user_id'] )
		                 ->first();

		if ( $authUser ) {
			return $authUser->user;
		}


		$pass = substr( str_shuffle( str_repeat( $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( 6 / strlen( $x ) ) ) ), 1, 6 );

		// Create user
		$user = User::create( [
			'nickname'                => !is_null( $data['nickname'] ) ? mb_strtolower( $data['nickname'] ) : substr( str_shuffle( str_repeat( $x = '0123456789', ceil( 15 / strlen( $x ) ) ) ), 1, 15 ),
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

		if ( isset( $data['avatar'] ) ) {

			$filename = "uploads/avatars/" . time() . ".jpg";
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

		return $user;

	}

}