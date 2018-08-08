<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
		return view( 'users.profile', [
			'user' => User::findOrFail( $id )
		] );
	}


	public function settings( $id ) {
		return view( 'users.profile_settings', [
			'user' => User::findOrFail( $id )
		] );
	}


	public function settings_store( Request $request, $id ) {

		$user                      = User::findOrFail( $id );
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
