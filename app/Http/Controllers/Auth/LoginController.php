<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Socialite;
use App\Models\SocialLogin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;

	protected $redirectTo = '/';

	public function __construct() {
		$this->middleware( 'guest' )->except( 'logout' );
	}


	// Social auth

	public function redirect( $service ) {
		return Socialite::driver( $service )->redirect();
	}

	public function callback( $service ) {

		$user = Socialite::with( $service )->user();

		//dd($user);

		$authUser = $this->findOrCreateUser( $service, $user );

		Auth::login( $authUser, true );

		return view( 'home' )->withDetails( $user )->withService( $service );
	}


	public function findOrCreateUser( $user, $service ) {
		$authUser = SocialLogin::where( 'provider_id', $user->id )->where( 'provider', $service )->first();

		if ( $authUser ) {
			return $authUser;
		}

		return SocialLogin::create( [
			'name'        => $user->name,
			'email'       => $user->email,
			'provider'    => $service,
			'provider_id' => $user->id,
			'token'       => $user->token,
		] );
	}

}
