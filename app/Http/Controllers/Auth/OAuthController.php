<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use App\User;
use App\Models\Profile;
use App\Models\OAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

		$data = $provider->mappingRequest( $service );

		$authUser = $this->findOrCreateUser( $data, $service );

		if ( $authUser == false )
			return redirect( 'login' )->withErrors( [ 'user_exist' => true ] );

		Auth::login( $authUser, true );

		return view( 'profile' );
	}


	public function findOrCreateUser( $data, $service ) {

		$authUser = OAuth::where( 'provider', $service )
		                 ->where( 'provider_id', $data['user_id'] )
		                 ->first();

		if ( $authUser )
			return $authUser->user;


		$existEmail = Validator::make( $data, [
			'email' => 'unique:users',
		] );

		if ( $existEmail->fails() )
			return false;

		$existNickname = Validator::make( $data, [
			'nickname' => 'unique:users',
		] );

		if ( $existNickname->fails() )
			return false;



		// CREATE USER
		$user = User::create( [
			'nickname'                => ! is_null( $data['nickname'] ) ? $data['nickname'] : time().$this->nicknameGenerator(),
			'email'                   => $data['email'],
			'password'                => bcrypt( $this->passwordGenerator() ),
			'registration_ip'         => request()->ip(),
			'registration_user_agent' => request()->header( 'User-Agent' ),
		] );


		$user_oauth              = new OAuth();
		$user_oauth->provider    = $service;
		$user_oauth->provider_id = $data['user_id'];
		$user_oauth->token       = $data['token'];

		$user->oAuth()->save( $user_oauth );

		// CREATE USER PROFILE
		$profile             = new Profile();
		$profile->first_name = $data['first_name'];
		$profile->last_name  = $data['last_name'];
		$profile->gender     = $data['gender'];
		$profile->birthday   = $data['birthday'];
		$profile->location   = $data['location'];
		$profile->avatar     = $this->saveAvatar( $data['avatar'] );

		$user->profile()->save( $profile );

		return $user;

	}


	private function saveAvatar( $imgUrl ) {
		if ( is_null( $imgUrl ) )
			return null;

		$filename = $this->nicknameGenerator() . time() . "_" . time() . $this->nicknameGenerator() . ".jpg";
		file_put_contents(
			$filename,
			file_get_contents( $imgUrl )
		);

		return $filename;
	}

	private function nicknameGenerator() {
		$alphabet    = '1234567890';
		$nick        = array();
		$alphaLength = strlen( $alphabet ) - 1;
		for ( $i = 0; $i < 5; $i ++ ) {
			$n      = rand( 0, $alphaLength );
			$nick [] = $alphabet[ $n ];
		}

		return implode( $nick  );
	}

	private function passwordGenerator() {
		$alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass        = array();
		$alphaLength = strlen( $alphabet ) - 1;
		for ( $i = 0; $i < 8; $i ++ ) {
			$n      = rand( 0, $alphaLength );
			$pass[] = $alphabet[ $n ];
		}

		return implode( $pass );
	}


}