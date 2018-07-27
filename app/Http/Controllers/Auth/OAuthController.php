<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Models\Profile;
use App\Models\OAuth;
use App\Http\Controllers\Controller;

class OAuthController  extends Controller {
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
		if ( $service == 'google' ) {


		} elseif ( $service == 'twitter' ) {


		} elseif ( $service == 'facebook' ) {

		} elseif ( $service == 'vkontakte' ) {
			$user = Socialite::with( $service )->fields( [ 'first_name', 'last_name', 'email', 'sex', 'bdate', 'city', 'photo_max_orig' ] )->user();
		}


		//dd($user);


		$authUser = $this->findOrCreateUser( $user, $service );

		Auth::login( $authUser, true );

		return view( 'profile' );
	}






	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function findOrCreateUser( $user, $service ) {

		$authUser = OAuth::where( 'provider', $service )
		                 ->where( 'provider_id', $user->id )
		                 ->first();
		//dd($authUser);

		if ( $authUser ) {
			return $authUser->user;
		}


		$pass = substr( str_shuffle( str_repeat( $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( 6 / strlen( $x ) ) ) ), 1, 6 );

		// CREATE USER
		$authUser = User::create( [
			'name'     => mb_strtolower( $user->nickname ),
			'email'    => mb_strtolower( $user->nickname ) . '@test.ru',
			'password' => bcrypt( $pass ),
		] );




		$socialLogin              = new OAuth();
		$socialLogin->provider    = $service;
		$socialLogin->provider_id = $user->id;
		$socialLogin->token       = $user->token;

		$authUser->oAuth()->save($socialLogin);

		// CREATE USER PROFILE

		if ( $user->getAvatar() ) {
			$filename = "uploads/avatars/" . time() . ".jpg";
			// The filename to save in the database.
			file_put_contents(
				$filename,
				file_get_contents( $user->getAvatar() )
			);
		}

		if ( $file = $user->getAvatar() ) {
			if ( $service == 'google' ) {
				$file = str_replace( '?sz=50', '', $file );
			} elseif ( $service == 'twitter' ) {
				$file = str_replace( '_normal', '', $file );
			} elseif ( $service == 'facebook' ) {
				$file = str_replace( 'type=normal', 'type=large', $file );
			}
		}


		$profile         = new Profile();
		$profile->avatar = $filename;
		$authUser->profile()->save( $profile );

		//dd($pass);
		return $authUser;

	}

}