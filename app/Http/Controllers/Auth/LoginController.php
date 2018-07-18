<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use Socialite;
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
        $this->middleware('guest')->except('logout');
    }




    // Social auth

	public function redirect( $service ) {
		return Socialite::driver( $service )->redirect();
	}

	public function callback( $service ) {
		$user = Socialite::with( $service )->user();

		$token = md5('663637731686155nWgZNilca738y4NGWA1q');
		echo $token;

		dd($user);
		return view ( 'home' )->withDetails( $user )->withService( $service );
	}
}
