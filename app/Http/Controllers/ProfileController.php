<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {

	public function __construct() {
		//$this->middleware('auth');
	}


	public function index() {
		return view( 'users.index', [
			'users' => User::orderBy( 'created_at', 'DESC' )->paginate( 15 )
		] );
	}


	public function profile( $id ) {

		$user = User::findOrFail( $id );


		return view( 'users.profile', [
			'user' => $user
		] );
	}


	public function settings( $id ) {
		if(Auth::id() != $id)
			abort(404, 'Page not found!');


		$user = User::findOrFail( $id );

		return view( 'users.profile_settings', [
			'user' => $user
		] );
	}


	public function settings_store( Request $request ) {

		$user                      = User::findOrFail( Auth::id() );
		$user->nickname            = $request->nickname;
		$user->profile->first_name = $request->first_name;
		$user->profile->last_name  = $request->last_name;
		$user->profile->birthday   = $request->birthday;
		$user->profile->gender     = $request->gender;
		$user->profile->about      = $request->about;
		$user->push();

		if($user->push())
			return redirect()->back()->with( [ 'status' => 'Профиль успешно обновлен!' ] );

		return redirect()->back()->with( [ 'status' => 'Ошибка! Данные не обновлены!' ] );
	}
}
