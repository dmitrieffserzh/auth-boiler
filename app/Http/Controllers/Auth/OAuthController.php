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
			dd( $data );

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
			dd( $data );

		} elseif ( $service == 'google' ) {

		}


		//dd($user);


		$authUser = $this->findOrCreateUser( $user, $service );

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
			'birthday'   => isset( $request->user['birthday'] ) ? str_replace('/', '.', $request->user['birthday']) : null,
			'location'   => isset( $request->user['location']['name'] ) ? $request->user['location']['name'] : null,
			'avatar'     => isset( $request->avatar ) ? str_replace( '?type=normal', '?width=1920', $request->avatar ) : null,
		);

		return $data;
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

		// Create user
		$user = User::create( [
			'nickname'                => mb_strtolower( $user->nickname ),
			'email'                   => mb_strtolower( $user->nickname ),
			'password'                => bcrypt( $pass ),
			'registration_ip'         => request()->ip(),
			'registration_user_agent' => request()->header( 'User-Agent' ),
		] );


		$user_oauth              = new OAuth();
		$user_oauth->provider    = $service;
		$user_oauth->provider_id = $user->id;
		$user_oauth->token       = $user->token;

		$authUser->oAuth()->save( $user_oauth );

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